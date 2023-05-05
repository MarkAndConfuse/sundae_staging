<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\AssignCSDService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class AssignCSDController extends Controller
{
    protected $assignCSD;

    public function __construct(AssignCSDService $assignCSD)
    {
        $this->assignCSD = $assignCSD;
    }

    public function index(Request $request)
    {
        try {
            $viewCSD = $this->assignCSD->indexView($request);
            return $viewCSD;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function csdDataTable(Request $request)
    {
        try {
            return $this->assignCSD->csdDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getCSDList(Request $request)
    {
        try {
            return $this->assignCSD->getCSDList($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addCSD(Request $request)
    {
        try {
            return $this->assignCSD->addCSD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addAssignCSD(Request $request)
    {
        try {
            return $this->assignCSD->addAssignCSD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editAssignCSD(Request $request)
    {
        try {
            return $this->assignCSD->editAssignCSD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteCSD(Request $request)
    {
        try {
            return $this->assignCSD->deleteCSD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}