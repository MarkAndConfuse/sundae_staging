<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\SubsContactsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class SubsContactsController extends Controller
{
    protected $subsContacts;

    public function __construct(SubsContactsService $subsContacts)
    {
        $this->subsContacts = $subsContacts;
    }

    public function index(Request $request)
    {
        try {
            $viewContacts = $this->subsContacts->indexView($request);
            return $viewContacts;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function subsContactsDataTable(Request $request)
    {
        try {
            return $this->subsContacts->subsContactsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getSubsContacts(Request $request)
    {
        try {
            return $this->subsContacts->getSubsContacts($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addsubsContact(Request $request)
    {
        try {
            return $this->subsContacts->addsubsContact($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editsubsContacts(Request $request)
    {
        try {
            return $this->subsContacts->editsubsContacts($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}