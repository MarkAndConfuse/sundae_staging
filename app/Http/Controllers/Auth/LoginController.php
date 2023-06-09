<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Classes\Traits\LogQueries;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use App\Models\CDBAccounts;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use LogQueries;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            if ($user->email == 'mescario@ics.com.ph'){
                
                $_email = $user->email;
                // $_email = 'asy-lu@ics.com.ph';
                // $_email = 'msoriano@ics.com.ph';
                
                $accounts = CDBAccounts::where('Email', strtoupper($_email))->first();

                session()->put('AccountName', $accounts->AccountName);
                session()->put('DomainAccount', $accounts->DomainAccount);
                session()->put('NickName', $accounts->NickName);

                $spName = explode(' ', $accounts->AccountName, 3);
                $first_name = $spName[0] .' '. $spName[1];
                
                session()->put('AccountID', $accounts->AccountID);
                session()->put('AccountGroup', $accounts->AccountGroup);
                session()->put('GoogleName', $user->name);
                session()->put('GoogleEmail', $_email);
                session()->put('FirstName', $first_name);
                session()->put('gAvatar', $accounts->GAvatar);

                $this->saveLogs('Login','Auth/Login Controller','Login user with ICS Gmail');

                return redirect('/dashboard');
            } 
            
        } catch (Exception $e) {
            \Log::info('error: '. $e->getMessage());
        }
    }
}
