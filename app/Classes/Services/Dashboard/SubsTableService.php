<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use App\Classes\Constants\Constants;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class SubsTableService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.subs_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function subscriptionDataTable($request)
    {
        try {
            $querySubscription = DB::table('subscriptions')
                    ->select('id', 
                    'subs_id_no', 
                    'so_number',
                    'invoice_date',
                    'so_date',
                    'material_number',
                    'material_desc',
                    'brand',
                    'category',
                    'bu',
                    'assigned_ao',
                    'activation_date',
                    'activation_status',
                    'customer_name',
                    'created_at')->get();            
                    
                    $results = datatables()->of($querySchedules);
                    return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a target="_blank" style="text-decoration:none;">
                            <button class="btn btn-primary btn-xs" type="button"
                                onclick="updateSubscription(this)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </a>
                        <a target="_blank" style="text-decoration:none;">
                            <button class="btn btn-danger btn-xs" type="button"
                                onclick="deleteSubscription(this)">
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

}
