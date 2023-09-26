<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if(auth()->check() && $user->two_factor_code)
        {
            if($user->two_factor_expires_at<now()) //expired
            {
                $user->resetTwoFactorCode();
                auth()->logout();

                session(['login_failed_user' => true]);
                return redirect('/')
                ->with('error', 'The two-factor code has expired. Please login again.');
            }

            if(!$request->is('verify*')) //prevent enless loop, otherwise send to verify
            {
                return redirect()->route('verify.index');
            }
        }

          // Check if the user has reached the maximum resend attempts
          $resendAttempts = Cache::get('resend_attempts_' . $user->id, 0);
          if ($resendAttempts >= 3) {

            $user->resetTwoFactorCode();
            auth()->logout();
             
            session(['login_failed_user' => true]);
            return redirect('/login')
            ->with('error', 'You have reached the maximum number of resend attempts. 
                    Please wait for another 10 minutes before logging in.');
          }

        return $next($request);
    }
}
