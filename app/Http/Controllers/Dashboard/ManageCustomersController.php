<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageCustomersService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class ManageCustomersController extends Controller
{
    protected $manageCustomer;

    public function __construct(ManageCustomersService $manageCustomer)
    {
        $this->manageCustomer = $manageCustomer;
    }

    public function index()
    {
        try {
            $viewCustomers = $this->manageCustomer->indexView();
            return $viewCustomers;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function customersDataTable(Request $request)
    {
        try {
            return $this->manageCustomer->customersDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function customersForUpdate()
    {
        try {
            $viewCustomersForUpdateSubscriptions = $this->manageCustomer->customersForUpdate();
            return $viewCustomersForUpdateSubscriptions;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function customersForUpdateDataTable(Request $request)
    {
        try {
            return $this->manageCustomer->customersForUpdateDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function createCustomer(Request $request)
    {
        try {
            return $this->manageCustomer->createCustomer($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateCustomer(Request $request)
    {
        try {
            return $this->manageCustomer->updateCustomer($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}