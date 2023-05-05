<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\ContactPersons;
use App\Models\CDBAccounts;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class FilterSelectService
{
    public function FilterAo($request)
    {
        try {
            $filterAos =  CDBAccounts::filterAo($request);
            return $filterAos;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function filterBySoNumber($request)
    {
        try {
            $filterBySo =  Subscriptions::filterBySoNumber($request);
            return $filterBySo;
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

}
