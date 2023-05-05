<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\AssignTCD;
use App\Models\ContactPersons;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class AssignTCDService
{
    public function indexView($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $queryTcd = AssignTCD::where('sub_id', $request->subsId)->get();
            return view('dashboard.manage_tcd', [
                'dateTime' => $dTime,
                'assignTcd' => $queryTcd
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function tcdDataTable($request)
    {
        try {
            $queryTcd = DB::table('assign_tcd')
            ->select('id', 
            'sub_id',
            'account_id',
            'tcd_name',
            'created_by',
            'email',
            'created_at')->get();
            $results = datatables()->of($queryTcd);
                return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-danger btn-xs" type="button"
                            data-tcd-id="'. $data->id .'"
                            data-sub-id="'. $data->sub_id .'"
                            data-tcd-name="'. $data->tcd_name .'"
                            data-account-id="'. $data->account_id .'"
                            data-tcd-email="'. $data->email .'"
                            onclick="deleteTcd(this)">
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

    public function getTCDList($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            $assignedTcd = AssignTCD::where('sub_id', $request->subsId)->get(); 
            return view('dashboard.assigned_tcd', [
                'dateTime' => $dTime,
                'assignedTcd' => $assignedTcd
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addTCD($request)
    {
        try {
            $addTcd =  AssignTCD::saveAddTcd($request);
            return $addTcd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addAssignTCD($request)
    {
        try {
            $addTcd =  AssignTCD::saveAssignTcd($request);
            return $addTcd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function editAssignTCD($request)
    {
        try {
            $editAssignTcd =  AssignTCD::saveEditAssignTcd($request);
            return $editAssignTcd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deleteTCD(Request $request)
    {
        try {
            $deleteTcd =  AssignTCD::saveDeletedTcd($request);
            return $deleteTcd;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
