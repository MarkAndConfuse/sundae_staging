<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\AssignTCDService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class AssignTCDController extends Controller
{
    protected $assignTCD;

    public function __construct(AssignTCDService $assignTCD)
    {
        $this->assignTCD = $assignTCD;
    }

    public function index(Request $request)
    {
        try {
            $viewTCD = $this->assignTCD->indexView($request);
            return $viewTCD;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function tcdDataTable(Request $request)
    {
        try {
            return $this->assignTCD->tcdDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getTCDList(Request $request)
    {
        try {
            return $this->assignTCD->getTCDList($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addTCD(Request $request)
    {
        try {
            return $this->assignTCD->addTCD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addAssignTCD(Request $request)
    {
        try {
            return $this->assignTCD->addAssignTCD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function editAssignTCD(Request $request)
    {
        try {
            return $this->assignTCD->editAssignTCD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteTCD(Request $request)
    {
        try {
            return $this->assignTCD->deleteTCD($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}