<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\AssignPMService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class AssignPMController extends Controller
{
    protected $assignPM;

    public function __construct(AssignPMService $assignPM)
    {
        $this->assignPM = $assignPM;
    }

    public function index(Request $request)
    {
        try {
            $viewPM = $this->assignPM->indexView($request);
            return $viewPM;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function pmDataTable(Request $request)
    {
        try {
            return $this->assignPM->pmDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getPM(Request $request)
    {
        try {
            return $this->assignPM->getPM($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addPM(Request $request)
    {
        try {
            return $this->assignPM->addPM($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addAssignPM(Request $request)
    {
        try {
            return $this->assignPM->addAssignPM($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editAssignPM(Request $request)
    {
        try {
            return $this->assignPM->editAssignPM($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deletePM(Request $request)
    {
        try {
            return $this->assignPM->deletePM($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}