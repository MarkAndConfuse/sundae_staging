<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Classes\Traits\LogQueries;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\CDBAccounts;
use App\Models\AssignPM;
use App\Models\AssignTCD;
use App\Models\AssignCSD;
use App\Models\ContactPersons;
use App\Models\Brands;
use App\Models\EmailNotifs;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;
use Mail;
use App\Mail\SubscriptionNotification;

class ManageSubscriptionService
{
    use LogQueries;

    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            // $this->saveLogs('View', 'Classes/Services/Dashboard/ManageSubscriptionService', 'View List of Subscriptions');
            return view('dashboard.subscription_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function select()
    {
        $subs = Subscriptions::get();
        $data = [];
        foreach($subs as $row){
            $contacts = AllContacts::where('CustomerID', $row->customer_id)->get();
            if (!empty($contacts)){
            $data[] =  (object) array(
                'contacts' => $contacts
                );
            }
        }
    }

    public function subscriptionDataTable($request)
    {
        try {
            $aID = session()->get('AccountID');
            $aGroup = session()->get('AccountGroup');
            if ($aID == '415'){
                $querySubscription = DB::table('subscriptions as s')->get();
            } else if ($aGroup == 'IT'){
                $querySubscription = DB::table('subscriptions as s')->get();
            } else {
            $querySubscription = DB::table('subscriptions as s')
                ->where('bu', '!=', 'BU6')->where('ao_id', $aID)
                ->get();
            }
            $results = datatables()->of($querySubscription);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a target="_blank" href="/subscriptions/'. $data->id .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-subs-id="'. $data->id .'"
                            data-so-number="'. $data->so_number .'"
                            data-invoice-date="'. $data->invoice_date .'"
                            data-so-date="'. $data->so_date .'"
                            data-material-no="'. $data->mat_number .'"
                            data-material-desc="'. $data->mat_desc .'"
                            data-brand="'. $data->brand .'"
                            data-category="'. $data->category .'"
                            data-bu="'. $data->bu .'"
                            data-assigned-ao="'. $data->assigned_ao .'"
                            data-ao-id="'. $data->ao_id .'"
                            data-activation-date="'. $data->activation_date .'"
                            data-activation-status="'. $data->activation_status .'"
                            data-customer-name="'. $data->customer_name .'"
                            data-customer-number="'. $data->customer_number .'"
                            data-customer-id="'. $data->customer_id .'"
                            data-terms="'. $data->terms .'"
                            data-p-schedule="'. $data->payment_schedule .'">
                            <i class="fa fa-eye"></i> View
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function addSubscription(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $getPm = CDBAccounts::where('AccountType', 'PM')
                    ->where('ValidTo', '!=', carbon::now())->get();
            $getTcd = CDBAccounts::where('AccountGroup', 'TCD')->get();
            $getCsd = CDBAccounts::where('AccountGroup', 'CSD')->get();
            $brands = Brands::orderBy('Brand')->get();
            
            return view('dashboard.add_subscription', [
                'dateTime' => $dTime,
                'getPm' => $getPm,
                'getTcd' => $getTcd,
                'getCsd' => $getCsd,
                'brands' => $brands
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function createSubscription(Request $request)
    {
        try {
            $createSubscriptions =  Subscriptions::saveCreatedSubscription($request);
            return $createSubscriptions;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function viewAndUpdateSubscription($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $getPm = CDBAccounts::where('AccountGroup', 'PMD')->get();
            $getTcd = CDBAccounts::where('AccountGroup', 'TCD')->get();
            $getCsd = CDBAccounts::where('AccountGroup', 'CSD')->get();
            $subs = Subscriptions::where('id', $request->sId)->first();
            
            $accounts = CDBAccounts::where('AccountID', $subs->ao_id)->first();
          
            $pmData = AssignPM::where('sub_id', $request->sId)->pluck('pm_name', 'account_id');
            $d = explode(",", $pmData);
            $skips = ["{","}",":","\""];
            $pM = str_replace($skips, '', $d);
          
            $tcdData = AssignTCD::where('sub_id', $request->sId)->pluck('tcd_name', 'account_id');
            $gT = explode(",", $tcdData);
            $skips = ["{","}",":","\""];
            $tCd = str_replace($skips, '', $gT);

            $csdData = AssignCSD::where('sub_id', $request->sId)->pluck('csd_name', 'account_id');
            $gC = explode(",", $csdData);
            $skips = ["{","}",":","\""];
            $cSd = str_replace($skips, '', $gC);
            
            return view('dashboard.view_and_update_subscription', [
                'dateTime' => $dTime,
                'getPm' => $getPm,
                'getTcd' => $getTcd,
                'getCsd' => $getCsd,
                'pM' => $pM,
                'tCd' => $tCd,
                'cSd' => $cSd,
                'subs' => $subs,
                'accounts' => $accounts        
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function viewSubscription($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $getPm = CDBAccounts::where('AccountGroup', 'PMD')->get();
            $getTcd = CDBAccounts::where('AccountGroup', 'TCD')->get();
            $getCsd = CDBAccounts::where('AccountGroup', 'CSD')->get();
            $subs = Subscriptions::where('id', $request->sId)->first();
            $aoAccounts = CDBAccounts::where('AccountID', $subs->ao_id)->first();
            $inv_date = Carbon::parse($subs->invoice_date)->format('F j, Y');
            if (!empty($subs->activation_date)){
                $act_date = Carbon::parse($subs->activation_date)->format('F j, Y');
            } else {
                $act_date = $subs->activation_date;
            }
            
            if (!empty($subs->activation_date)){
                $exp_date = Carbon::parse($subs->activation_date)->addYears($subs->terms)->format('F j, Y');
            } else {
                $exp_date = Carbon::parse($currTime)->addYears($subs->terms)->format('F j, Y');
            }
           
            $pmDatax = AssignPM::where('sub_id', $request->sId)->pluck('pm_name');
            $d = explode(",", $pmDatax);
            $skips = ["[","]","\""];
            $pM = str_replace($skips, '', $d);

            $pmData = AssignPM::where('sub_id', $request->sId)->get();
            $data = [];

            foreach($pmData as $row){
                $acc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
                
                $aAvatar = json_decode(json_encode($acc), TRUE);
                $n = Arr::flatten($aAvatar);

                if (!empty($acc)){
                $data[] =  array(
                    'acc' => $acc
                    );
                }
            }

            $pmA = [];
            $p = json_decode(json_encode($data), TRUE);
            foreach($p as $i){
                $pmA[] = Arr::flatten($i);
                
            }

            $tcdDatax = AssignTCD::where('sub_id', $request->sId)->pluck('tcd_name');
            $gT = explode(",", $tcdDatax);
            $skips = ["[","]","\""];
            $tC = str_replace($skips, '', $gT);

            $tcdData = AssignTCD::where('sub_id', $request->sId)->get();
            
            $tData = [];
            foreach($tcdData as $row){
                $tAcc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
               
                $tAvatar = json_decode(json_encode($tAcc), TRUE);
                $n = Arr::flatten($tAvatar);

                if (!empty($tAcc)){
                $tData[] =  array(
                    'tAcc' => $tAcc
                    );
                }
            }

            $aTCD = [];
            $pTcd = json_decode(json_encode($tData), TRUE);
            
            foreach($pTcd as $i){
                $aTCD[] = Arr::flatten($i);
            }

            $csdDatax = AssignCSD::where('sub_id', $request->sId)->pluck('csd_name');
            $gC = explode(",", $csdDatax);
            $skips = ["[","]","\""];
            $cS = str_replace($skips, '', $gC);

            $csdData = AssignCSD::where('sub_id', $request->sId)->get();
            $cData = [];
            foreach($csdData as $row){
                $cAcc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
                $cAvatar = json_decode(json_encode($cAcc), TRUE);
                $nC = Arr::flatten($cAvatar);

                if (!empty($cAcc)){
                $cData[] =  array(
                    'cAcc' => $cAcc
                    );
                }
            }

            $aCSD = [];
            $pCsd = json_decode(json_encode($cData), TRUE);
            foreach($pCsd as $i){
                $aCSD[] = Arr::flatten($i);
            }

            if (empty($subs->activation_date)){
                $notif90 = 'Please set activation date';
            } else {
                $notif90 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(90)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif60 = 'Please set activation date';
            } else {
                $notif60 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(60)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif30 = 'Please set activation date';
            } else {
                $notif30 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(30)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif15 = 'Please set activation date';
            } else {
                $notif15 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(15)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif7 = 'Please set activation date';
            } else {
                $notif7 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(7)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif1 = 'Please set activation date';
            } else {
                $notif1 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(1)->format('F j, Y');
            }

            $contactPerson = AllContacts::where('ContactID', $subs->contact_id)->first();

            return view('dashboard.view_subscription', [
                'dateTime' => $dTime,
                'getPm' => $getPm,
                'getTcd' => $getTcd,
                'getCsd' => $getCsd,
                'pM' => $pmA,
                'tCd' => $aTCD,
                'cSd' => $aCSD,
                'subs' => $subs,
                'gAvatar' => $aoAccounts->GAvatar,
                'inv_date' => $inv_date,
                'act_date' => $act_date,
                'exp_date' => $exp_date,
                'notif90' => $notif90,
                'notif60' => $notif60,
                'notif30' => $notif30,
                'notif15' => $notif15,
                'notif7' => $notif7,
                'notif1' => $notif1,
                'contactPerson' => $contactPerson
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function viewLinkSubscription($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $dTimeNow = date('m/d/Y H:i:s');
            $getPm = CDBAccounts::where('AccountGroup', 'PMD')->get();
            $getTcd = CDBAccounts::where('AccountGroup', 'TCD')->get();
            $getCsd = CDBAccounts::where('AccountGroup', 'CSD')->get();
            $subs = Subscriptions::where('id', $request->sId)->first();
            $aoAccounts = CDBAccounts::where('AccountID', $subs->ao_id)->first();
            $inv_date = Carbon::parse($subs->invoice_date)->format('F j, Y');
            
            if (!empty($subs->activation_date)){
                $act_date = Carbon::parse($subs->activation_date)->format('F j, Y');
            } else {
                $act_date = $subs->activation_date;
            }

            if (!empty($subs->activation_date)){
                $exp_date = Carbon::parse($subs->activation_date)->addYears($subs->terms)
                ->format('F j, Y');
            } else {
                $exp_date = Carbon::parse($dTimeNow)->addYears($subs->terms)->format('F j, Y');
            }
         
            $pmDatax = AssignPM::where('sub_id', $request->sId)->pluck('pm_name');
            $d = explode(",", $pmDatax);
            $skips = ["[","]","\""];
            $pM = str_replace($skips, '', $d);

            $pmData = AssignPM::where('sub_id', $request->sId)->get();
            $data = [];

            foreach($pmData as $row){
                $acc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
                
                $aAvatar = json_decode(json_encode($acc), TRUE);
                $n = Arr::flatten($aAvatar);

                if (!empty($acc)){
                $data[] =  array(
                    'acc' => $acc
                    );
                }
            }

            $pmA = [];
            $p = json_decode(json_encode($data), TRUE);
            foreach($p as $i){
                $pmA[] = Arr::flatten($i);
                
            }

            $tcdDatax = AssignTCD::where('sub_id', $request->sId)->pluck('tcd_name');
            $gT = explode(",", $tcdDatax);
            $skips = ["[","]","\""];
            $tC = str_replace($skips, '', $gT);

            $tcdData = AssignTCD::where('sub_id', $request->sId)->get();
            
            $tData = [];
            foreach($tcdData as $row){
                $tAcc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
               
                $tAvatar = json_decode(json_encode($tAcc), TRUE);
                $n = Arr::flatten($tAvatar);

                if (!empty($tAcc)){
                $tData[] =  array(
                    'tAcc' => $tAcc
                    );
                }
            }

            $aTCD = [];
            $pTcd = json_decode(json_encode($tData), TRUE);
            
            foreach($pTcd as $i){
                $aTCD[] = Arr::flatten($i);
            }

            $csdDatax = AssignCSD::where('sub_id', $request->sId)->pluck('csd_name');
            $gC = explode(",", $csdDatax);
            $skips = ["[","]","\""];
            $cS = str_replace($skips, '', $gC);

            $csdData = AssignCSD::where('sub_id', $request->sId)->get();
            $cData = [];
            foreach($csdData as $row){
                $cAcc = CDBAccounts::select('AccountName', 'GAvatar')
                ->where('AccountID', $row->account_id)->get();
                $cAvatar = json_decode(json_encode($cAcc), TRUE);
                $nC = Arr::flatten($cAvatar);

                if (!empty($cAcc)){
                $cData[] =  array(
                    'cAcc' => $cAcc
                    );
                }
            }

            $aCSD = [];
            $pCsd = json_decode(json_encode($cData), TRUE);
            foreach($pCsd as $i){
                $aCSD[] = Arr::flatten($i);
                
            }

            if (empty($subs->activation_date)){
                $notif90 = 'Please set activation date';
            } else {
                $notif90 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(90)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif60 = 'Please set activation date';
            } else {
                $notif60 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(60)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif30 = 'Please set activation date';
            } else {
                $notif30 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(30)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif15 = 'Please set activation date';
            } else {
                $notif15 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(15)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif7 = 'Please set activation date';
            } else {
                $notif7 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(7)->format('F j, Y');
            }
            if (empty($subs->activation_date)){
                $notif1 = 'Please set activation date';
            } else {
                $notif1 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(1)->format('F j, Y');
            }
            $contactPerson = AllContacts::where('ContactID', $subs->contact_id)->first();
    
            return view('dashboard.view_link_subs', [
                'dateTime' => $dTime,
                'getPm' => $getPm,
                'getTcd' => $getTcd,
                'getCsd' => $getCsd,
                'pM' => $pmA,
                'tCd' => $aTCD,
                'cSd' => $aCSD,
                'subs' => $subs,
                'gAvatar' => $aoAccounts->GAvatar,
                'inv_date' => $inv_date,
                'act_date' => $act_date,
                'exp_date' => $exp_date,
                'notif90' => $notif90,
                'notif60' => $notif60,
                'notif30' => $notif30,
                'notif15' => $notif15,
                'notif7' => $notif7,
                'notif1' => $notif1,
                'contactPerson' => $contactPerson
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function updateSubscription(Request $request)
    {
        try {
            $updateSubscriptions =  Subscriptions::saveUpdatedSubscription($request);
            return $updateSubscriptions;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function getBrands(Request $request)
    {
        try {
            $brands = Brands::orderBy('Brand')->get();
            return response()->json($brands);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function getSubContacts(Request $request)
    {
        try {
            $subContacts = AllContacts::where('CustomerID', $request->custoId)->get();
            return response()->json($subContacts);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function getSingleContact(Request $request)
    {
        try {
            $singleContact = AllContacts::where('ContactID', $request->contactId)->get();
            return response()->json($singleContact);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }
}
