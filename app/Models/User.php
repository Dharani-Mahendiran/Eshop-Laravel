<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $dates = [
        'updated_at',
        'created_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    protected $attributes = [
            'lname' => '',
            'phone' => '',
            'address' => '',
            'city' =>  '',
            'state' => '',
            'country'=>  '',
            'pincode' =>  '',
            'has_deleted' => '0',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /*Generate 6 digits MFA code for the User*/
        public function generateTwoFactorCode()
        {
            $this->timestamps = false;
            $this->two_factor_code = rand(100000, 999999);
            $this->two_factor_expires_at = now()->addMinutes(10);
            $this->save();
        }

        /*Reset the MFA code generated earlier*/
        public function resetTwoFactorCode()
        {
            $this->timestamps = false;
            $this->two_factor_code = null;
            $this->two_factor_expires_at = null;
            $this->save();
        }


        public function hasTwoFactorAuthenticationEnabled()
        {
            return !is_null($this->two_factor_code) && now()->lt($this->two_factor_expires_at);
        }
}
