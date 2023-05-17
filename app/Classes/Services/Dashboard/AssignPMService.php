<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Classes\Traits\LogQueries;
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

class AssignPMService
{
    use LogQueries;

    public function indexView($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $queryPm = AssignPm::where('sub_id', $request->subsId)->get();
            return view('dashboard.manage_pm', [
                'dateTime' => $dTime,
                'assignPm' => $queryPm
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function pmDataTable($request)
    {
        try {
            $queryPm = DB::table('assign_pm')
            ->select('id', 
            'sub_id',
            'account_id',
            'pm_name',
            'created_by',
            'email',
            'created_at')->where('sub_id', $request->subsId)->get();
            $results = datatables()->of($queryPm);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-danger btn-xs" type="button"
                            data-pm-id="'. $data->id .'"
                            data-subs-id="'. $data->sub_id .'"
                            data-pm-name="'. $data->pm_name .'"
                            data-account-id="'. $data->account_id .'"
                            data-pm-email="'. $data->email .'"
                            onclick="deletePm(this)">
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

    public function getPM($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $assignedPm = AssignPM::where('sub_id', $request->subsId)->get(); 
            return view('dashboard.assigned_pm', [
                'dateTime' => $dTime,
                'assignedPm' => $assignedPm
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addPm($request)
    {
        try {
            $addPm =  AssignPM::saveAddPm($request);
            return $addPm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addAssignPm($request)
    {
        try {
            $addAssignPm =  AssignPM::saveAssignPm($request);
            $this->saveLogs('Add', 
                            'Classes/Services/Dashboard/AssignPMService', 
                            'Add New Assigned PM');
            return $addAssignPm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function editAssignPm($request)
    {
        try {
            $addAssignPm =  AssignPM::saveEditAssignPm($request);
            $this->saveLogs('Edit / Update', 
                            'Classes/Services/Dashboard/AssignPMService', 
                            'Edit Assigned PM');
            return $addAssignPm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deletePm(Request $request)
    {
        try {
            $deletePm =  AssignPM::saveDeletedPm($request);
            $this->saveLogs('Delete', 
                            'Classes/Services/Dashboard/AssignPMService', 
                            'Delete Assigned PM');
            return $deletePm;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
