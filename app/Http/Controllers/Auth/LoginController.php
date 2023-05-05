<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
                $accounts = CDBAccounts::where('Email', strtoupper($user->email))->first();
                session()->put('GoogleId', $user->id);
                session()->put('GoogleName', $user->name);
                session()->put('GoogleEmail', $user->email);
                session()->put('gAvatar', $accounts->GAvatar);
                return redirect('/dashboard');
            } 

            $accounts = CDBAccounts::where('Email', $user->email)->first();
            session()->put('GoogleId', $user->id);
            session()->put('GoogleName', $user->name);
            session()->put('GoogleEmail', $user->email);
            session()->put('gAvatar', $accounts->GAvatar);
            return redirect('/dashboard');
            
    
        } catch (Exception $e) {
            \Log::info('error: '. $e->getMessage());
        }
    }
}
