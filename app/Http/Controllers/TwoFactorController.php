<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'twofactor']);
    }


    public function index() 
    {
        return view('auth.twoFactor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);
    
        $user = auth()->user();
    
        if ($request->input('two_factor_code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();

            if(Auth::user()->role_as=='0'){
                return redirect('/')->with('message', 'Welcome, ' . Auth::user()->name);
            }
           elseif(Auth::user()->role_as=='1'){
            return redirect('admin/dashboard')->with('message', 'Welcome to the Admin Dashboard, '. Auth::user()->name);
            }
            else{
            return redirect('/home')->with('warning', 'Error occured');
            }

        } else {
            // Notify the user with the TwoFactorCode notification if the code is incorrect
            $user->notify(new TwoFactorCode($user, $user->email));
    
            return redirect()->back()->withErrors(['two_factor_code' => 'The two-factor code you have entered does not match']);
        }
    }
    

    public function resend()
    {
        $user = auth()->user();

        // Check if the user has reached the maximum number of resend attempts
        $resendAttempts = Cache::get('resend_attempts_' . $user->id, 0);
        if ($resendAttempts >= 3) {
            return redirect()->back()->withErrors(['resend_limit' => 'You have reached the maximum number of resend attempts. Please try again later.']);
        }

        // Generate and send the two-factor code
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode($user, $user->email));

        // Increment the resend attempts and store in cache for a certain time
        Cache::put('resend_attempts_' . $user->id, $resendAttempts + 1, now()->addMinutes(10));

        return redirect()->back()->withMessage('The two-factor code has been sent again');
    }
}

?>