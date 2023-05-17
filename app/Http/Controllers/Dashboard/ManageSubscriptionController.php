<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageSubscriptionService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class ManageSubscriptionController extends Controller
{
    protected $manageSubscription;

    public function __construct(ManageSubscriptionService $manageSubscription)
    {
        $this->manageSubscription = $manageSubscription;
    }

    public function index()
    {
        try {
            $viewSubscription = $this->manageSubscription->indexView();
            return $viewSubscription;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function select(Request $request)
    {
        try {
            $select = $this->manageSubscription->select($request);
            return $select;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function runner(Request $request)
    {
        try {
            $runner = $this->manageSubscription->runner($request);
            return $runner;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function subscriptionDataTable(Request $request)
    {
        try {
            return $this->manageSubscription->subscriptionDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->addSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function createSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->createSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function viewSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->viewSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function viewLinkSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->viewLinkSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function viewAndUpdateSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->viewAndUpdateSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getPmTcdCsd(Request $request)
    {
        try {
            return $this->manageSubscription->getPmTcdCsd($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateSubscription(Request $request)
    {
        try {
            return $this->manageSubscription->updateSubscription($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getBrands(Request $request)
    {
        try {
            return $this->manageSubscription->getBrands($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getSubContacts(Request $request)
    {
        try {
            return $this->manageSubscription->getSubContacts($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getSingleContact(Request $request)
    {
        try {
            return $this->manageSubscription->getSingleContact($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}