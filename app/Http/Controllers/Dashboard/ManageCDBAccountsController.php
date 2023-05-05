<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageCDBAccountsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class ManageCDBAccountsController extends Controller
{
    protected $manageCDBAccount;

    public function __construct(ManageCDBAccountsService $manageCDBAccount)
    {
        $this->manageCDBAccount = $manageCDBAccount;
    }

    public function index()
    {
        try {
            $viewCDBAccounts = $this->manageCDBAccount->indexView();
            return $viewCDBAccounts;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function cdbAccountsDataTable(Request $request)
    {
        try {
            return $this->manageCDBAccount->cdbAccountsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function viewAccountsTcd()
    {
        try {
            $viewCDBAccountsTcd = $this->manageCDBAccount->viewAccountsTcd();
            return $viewCDBAccountsTcd;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function cdbAccountsTcdDataTable(Request $request)
    {
        try {
            return $this->manageCDBAccount->cdbAccountsTcdDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function viewAccountsCsd()
    {
        try {
            $viewCDBAccountsCsd = $this->manageCDBAccount->viewAccountsCsd();
            return $viewCDBAccountsCsd;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function cdbAccountsCsdDataTable(Request $request)
    {
        try {
            return $this->manageCDBAccount->cdbAccountsCsdDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}