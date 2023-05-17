<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Classes\Traits\LogQueries;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\AssignCSD;
use App\Models\ContactPersons;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class AssignCSDService
{
    use LogQueries;

    public function indexView($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $queryCsd = AssignCSD::where('sub_id', $request->subsId)->get();
            return view('dashboard.manage_csd', [
                'dateTime' => $dTime,
                'assignCsd' => $queryCsd
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function csdDataTable($request)
    {
        try {
            $queryCsd = DB::table('assign_csd')
            ->select('id', 
            'sub_id',
            'account_id',
            'csd_name',
            'created_by',
            'email',
            'created_at')->get();
            $results = datatables()->of($queryCsd);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-danger btn-xs" type="button"
                            data-csd-id="'. $data->id .'"
                            data-subs-id="'. $data->sub_id .'"
                            data-csd-name="'. $data->csd_name .'"
                            data-account-id="'. $data->account_id .'"
                            data-csd-email="'. $data->email .'"
                            onclick="deleteCsd(this)">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCSDList($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $assignedCsd = AssignCSD::where('sub_id', $request->subsId)->get(); 
            return view('dashboard.assigned_csd', [
                'dateTime' => $dTime,
                'assignedCsd' => $assignedCsd
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addCSD($request)
    {
        try {
            $addCsd =  AssignCSD::saveAddCsd($request);
            return $addCsd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addAssignCSD($request)
    {
        try {
            $addCsd =  AssignCSD::saveAssignCsd($request);
            $this->saveLogs('Add', 
                            'Classes/Services/Dashboard/AssignCSDService', 
                            'Add New Assigned CSD');
            return $addCsd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function editAssignCSD($request)
    {
        try {
            $editAssignCsd =  AssignCSD::saveEditAssignCsd($request);
            $this->saveLogs('Edit / Update', 
                            'Classes/Services/Dashboard/AssignCSDService', 
                            'Edit Assigned CSD');
            return $editAssignCsd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deleteCSD(Request $request)
    {
        try {
            $deleteCsd =  AssignCSD::saveDeletedCsd($request);
            $this->saveLogs('Delete', 
                            'Classes/Services/Dashboard/AssignCSDService', 
                            'Delete Assigned CSD');
            return $deleteCsd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
