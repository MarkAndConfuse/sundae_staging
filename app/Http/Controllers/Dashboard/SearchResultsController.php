<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\SearchResultsService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class SearchResultsController extends Controller
{
    protected $searchResult;

    public function __construct(SearchResultsService $searchResult)
    {
        $this->searchResult = $searchResult;
    }

    public function index(Request $request)
    {
        try {
            $getResult = $this->searchResult->indexView($request);
            return $getResult;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function liveSearchDataTable(Request $request)
    {
        try {
            return $this->searchResult->liveSearchDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
}