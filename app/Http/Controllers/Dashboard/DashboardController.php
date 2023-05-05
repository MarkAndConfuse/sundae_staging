<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Subscriptions;
use Validator;
use Auth;
use Image;
use Session;
use Exception;

class DashboardController extends Controller
{
	public function login()
	{
		try {
			return view('auth.login');
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}
	public function dashboard()
	{
		try {
		date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
		$subsTotal = Subscriptions::count();
		return view('dashboard.index', [
			'dateTime' => $dTime,
			'subsTotal' => $subsTotal
		]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

}