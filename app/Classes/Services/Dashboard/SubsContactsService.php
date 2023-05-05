<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\AssignPM;
use App\Models\ContactPersons;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class SubsContactsService
{
    public function indexView($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $customerContacts = AllContacts::where('CustomerID', $request->custoId)->get();
            return view('dashboard.for_contacts', [
                'dateTime' => $dTime,
                'customerContacts' => $customerContacts
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function subsContactsDataTable($request)
    {
        try {
            $queryContacts = DB::connection('sqlsrv2')->table('devcusto.dbo.vw_AllContact')
            ->select('ContactID', 
            'CustomerID',
            'CustomerTypeCode',
            'ContactName',
            'Designation',
            'Email',
            'Telephone',
            'Mobile')->where('CustomerID', $request->custoId)->get();
            $results = datatables()->of($queryContacts);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-contact-id="'. $data->ContactID .'"
                            data-customer-id="'. $data->CustomerID .'"
                            data-customer-type-code="'. $data->CustomerTypeCode .'"
                            data-contact-name="'. $data->ContactName .'"
                            data-designation="'. $data->Designation .'"
                            data-email="'. $data->Email .'"
                            data-mobile="'. $data->Mobile .'"
                            data-telephone="'. $data->Telephone .'"
                            onclick="viewContactInformation(this)">
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

    public function addSubsContact($request)
    {
        try {
            $addContact =  ContactPersons::saveSubsContact($request);
            return $addContact;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addAssignPm($request)
    {
        try {
            $addAssignPm =  AssignPM::saveAssignPm($request);
            return $addAssignPm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function editAssignPm($request)
    {
        try {
            $addAssignPm =  AssignPM::saveEditAssignPm($request);
            return $addAssignPm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
