<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Models\Subscriptions;
use App\Models\AllContacts;
use App\Models\AssignPM;
use App\Models\ContactPersons;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Datatables;
use App\User;
use DB;
use Exception;
use Auth;

class SearchResultsService
{
    public function indexView($request)
    {
        try {
            // this is bypassed. I made an ajax call directly to the datatable url
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');

            $searchResult = Http::get('https://ice-cream.ics.com.ph/api/liveSearch?key='. $request->keyWord .'');
           
            return view('dashboard.live_search_table', [
                'dateTime' => $dTime,
                'searchResult' => $searchResult
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function liveSearchDataTable($request)
    {
        try {
            $data = Http::get('https://ice-cream.ics.com.ph/api/liveSearch?key='. $request->keyWord .'');   
            $searchResult = $data['data'];
      
            $main = datatables()->of(collect($searchResult));
                return $main
                    ->addColumn('action', function ($data) {
                    $action = '<a target="_blank" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-cus-id="'. $data['CustomerID'] .'"
                            data-cus-no="'. $data['CustomerNumber'] .'"
                            data-cus-name="'. $data['CustomerName'] .'"
                            onclick="selectCus(this)">
                            <i class="fa fa-check-circle"></i> SELECT
                        </button>
                    </a>';
                return $action;
                        
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

   
}
