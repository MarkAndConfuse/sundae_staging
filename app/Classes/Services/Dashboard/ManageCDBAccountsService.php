<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\ContactPersons;
use App\Models\CDBAccounts;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class ManageCDBAccountsService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.cdb_accounts_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cdbAccountsDataTable()
    {
        $cdbAccounts = DB::connection('sqlsrv2')->table('devcusto.dbo.cdbAccounts')->where('AccountType', 'PM')->where('ValidTo', '>', Carbon::now())
                            ->select(
                            'AccountID',
                            'AONumber',
                            'AccountName',
                            'AccountGroup',
                            'AccountType',
                            'Email'
                            )
                            ->get();
                            $cdbCollection = collect($cdbAccounts);
                            $results = datatables()->of($cdbCollection);
                            return $results
                            ->addColumn('action', function ($data) {
                            $action = '<a target="_blank" style="text-decoration:none;">
                            <button class="btn btn-warning btn-xs" type="button"
                                data-account-id="'. $data->AccountID .'"
                                data-aonumber="'. $data->AONumber .'"
                                data-account-name="'. $data->AccountName .'"
                                data-account-group="'. $data->AccountGroup .'"
                                data-account-type="'. $data->AccountType .'"
                                data-account-email="'. $data->Email .'"
                            onclick="selectPm(this)">
                        <i class="fa fa-plus-circle"></i> SELECT
                    </button>
                </a>';
            return $action;
            })
        ->make();
    }

    public function viewAccountsTcd()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.cdb_accounts_tcd_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cdbAccountsTcdDataTable()
    {
        $cdbAccountsTcd = DB::connection('sqlsrv2')->table('devcusto.dbo.cdbAccounts')->where('AccountGroup', 'TCD')
                            ->select(
                            'AccountID',
                            'AONumber',
                            'AccountName',
                            'AccountGroup',
                            'AccountType',
                            'Email'
                            )
                            ->get();
                            $cdbCollection = collect($cdbAccountsTcd);
                            $results = datatables()->of($cdbCollection);
                            return $results
                            ->addColumn('action', function ($data) {
                            $action = '<a target="_blank" style="text-decoration:none;">
                            <button class="btn btn-warning btn-xs" type="button"
                                data-account-id="'. $data->AccountID .'"
                                data-aonumber="'. $data->AONumber .'"
                                data-account-name="'. $data->AccountName .'"
                                data-account-group="'. $data->AccountGroup .'"
                                data-account-type="'. $data->AccountType .'"
                                data-account-email="'. $data->Email .'"
                            onclick="selectTcd(this)">
                        <i class="fa fa-plus-circle"></i> SELECT
                    </button>
                </a>';
            return $action;
            })
        ->make();
    }

    public function viewAccountsCsd()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            return view('dashboard.cdb_accounts_csd_table', [
                'dateTime' => $dTime,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function cdbAccountsCsdDataTable()
    {
        $cdbAccountsCsd = DB::connection('sqlsrv2')->table('devcusto.dbo.cdbAccounts')->where('AccountGroup', 'CSD')
                            ->select(
                            'AccountID',
                            'AONumber',
                            'AccountName',
                            'AccountGroup',
                            'AccountType',
                            'Email'
                            )
                            ->get();
                            $cdbCollection = collect($cdbAccountsCsd);
                            $results = datatables()->of($cdbCollection);
                            return $results
                            ->addColumn('action', function ($data) {
                            $action = '<a target="_blank" style="text-decoration:none;">
                            <button class="btn btn-warning btn-xs" type="button"
                                data-account-id="'. $data->AccountID .'"
                                data-aonumber="'. $data->AONumber .'"
                                data-account-name="'. $data->AccountName .'"
                                data-account-group="'. $data->AccountGroup .'"
                                data-account-type="'. $data->AccountType .'"
                                data-account-email="'. $data->Email .'"
                            onclick="selectCsd(this)">
                        <i class="fa fa-plus-circle"></i> SELECT
                    </button>
                </a>';
            return $action;
            })
        ->make();
    }

}
