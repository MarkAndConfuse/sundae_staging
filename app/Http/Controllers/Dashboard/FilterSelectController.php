<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\FilterSelectService;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Image;
use Exception;

class FilterSelectController extends Controller
{
    protected $filterSelect;

    public function __construct(FilterSelectService $filterSelect)
    {
        $this->filterSelect = $filterSelect;
    }

    public function FilterAo(Request $request)
    {
        try {
            return $this->filterSelect->filterAo($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function filterBySoNumber(Request $request)
    {
        try {
            return $this->filterSelect->filterBySoNumber($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}