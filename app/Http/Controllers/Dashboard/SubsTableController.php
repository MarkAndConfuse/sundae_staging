<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\SubsTableService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class SubsTableController extends Controller
{
    protected $subsTable;

    public function __construct(SubsTableService $subsTable)
    {
        $this->subsTable = $subsTable;
    }

    public function index()
    {
        try {
            $viewSubsTable = $this->subsTable->indexView();
            return $viewSubsTable;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function subsTable(Request $request)
    {
        try {
            return $this->subsTable->subsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}