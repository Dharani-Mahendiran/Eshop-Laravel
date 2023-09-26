<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(){

        if(Auth::user()->role_as=='0' || Auth::user()->role_as=='1'){
            $user = Auth::user();
            $email = $user->email; // Get the user's email address
            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCode($user, $email));
            return redirect('verify');
        }
        else{
            return redirect('/home')->with('warning', 'Error occured');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}