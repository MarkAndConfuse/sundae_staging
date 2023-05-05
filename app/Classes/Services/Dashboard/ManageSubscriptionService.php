<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
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
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
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

    public function runner ($request)
    {
        // $res = DB::connection('sqlsrv2')->select(DB::raw("SELECT devcusto.dbo.cdbCustomer.CustomerName FROM devcusto.dbo.cdbCustomer 
        // INNER JOIN devcusto.dbo.vw_AllContact ON devcusto.dbo.vw_AllContact.CustomerID = devcusto.dbo.cdbCustomer.CustomerID"));
        // \Log::info($res);
        $subs = Subscriptions::get();
        // \Log::info('select: '. $subs);
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
            $querySubscription = DB::table('subscriptions as s')
            ->get();
            $results = datatables()->of($querySubscription);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
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
                            data-p-schedule="'. $data->payment_schedule .'"
                            onclick="viewSubscription(this, '. $data->id .')">
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
            // \Log::info($pM);
          
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
            $act_date = Carbon::parse($subs->activation_date)->format('F j, Y');
            $exp_date = Carbon::parse($subs->activation_date)->addYears($subs->terms)->format('F j, Y');
            // $contactPersons = ContactPersons::where('CustomerId', $subs->customer_id)->get();
            
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
                \Log::info($aTCD);
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

            $notif90 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(90)->format('F j, Y');
            $notif60 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(60)->format('F j, Y');
            $notif30 = Carbon::parse($subs->activation_date)->addYears($subs->terms)->subDays(30)->format('F j, Y');

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

}
