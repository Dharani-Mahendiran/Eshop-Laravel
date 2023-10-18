<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table ='orders';
    protected $fillable = [
        'name',
        'lname',
        'email',
        'phone',
        'alt_contact',
        'city',
        'state',
        'country',
        'pincode',
        'status',
        'message',
        'tracking_number',
    ];
}
