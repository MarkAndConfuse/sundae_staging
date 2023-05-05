<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\ContactPersons;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class ManageCustomersService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.customers_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function customersDataTable()
    {
        $customers = DB::connection('sqlsrv2')->table('devcusto.dbo.cdbCustomer')
                    ->select('CustomerID',
                    'CustomerNumber',
                    'CustomerName')
                    ->get();
        // $customers = DB::connection('sqlsrv2')->select(DB::raw("SELECT devcusto.dbo.cdbCustomer.CustomerName, 
        // devcusto.dbo.cdbCustomer.CustomerID, devcusto.dbo.cdbCustomer.CustomerID FROM devcusto.dbo.cdbCustomer 
        // INNER JOIN devcusto.dbo.vw_AllContact ON 
        // devcusto.dbo.vw_AllContact.CustomerID = devcusto.dbo.cdbCustomer.CustomerID"));
                $cusCollection = collect($customers);
                $results = datatables()->of($cusCollection);
                return $results
                
                ->addColumn('action', function ($data) {
                $action = '<a target="_blank" style="text-decoration:none;">
                    <button class="btn btn-warning btn-xs" type="button"
                        data-custo-id="'. $data->CustomerID .'"
                        data-custo-number="'. $data->CustomerNumber .'"
                        data-custo-name="'. $data->CustomerName .'"
                        onclick="addCustomer(this)">
                        <i class="fa fa-check-circle"></i> SELECT
                    </button>
                </a>';
            return $action;
            })
        ->make();
           
    }

    public function customersForUpdate()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.customers_table_for_update_subscription', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function customersForUpdateDataTable()
    {
        $customers = DB::connection('sqlsrv2')->table('devcusto.dbo.cdbCustomer')
                    ->select('CustomerID',
                    'CustomerNumber',
                    'CustomerName')
                    ->get();
                    $cusCollection = collect($customers);
                    $results = datatables()->of($cusCollection);
                    return $results
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                    <button class="btn btn-warning btn-xs" type="button"
                        data-custo-id="'. $data->CustomerID .'"
                        data-custo-number="'. $data->CustomerNumber .'"
                        data-custo-name="'. $data->CustomerName .'"
                        onclick="addCustomerForUpdateSubscription(this)">
                        <i class="fa fa-check-circle"></i> Add
                    </button>
                </a>';
            return $action;
            })
        ->make();
    }
    
    public function createCustomers(Request $request)
    {
        try {
            $createSubscriptions =  Subscriptions::saveCreatedCustomer($request);
            return $createSubscriptions;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function updateCustomers(Request $request)
    {
        try {
            $updateCustomers =  Subscriptions::saveUpdatedCustomer($request);
            return $updateCustomers;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
