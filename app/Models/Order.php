<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table ='orders';
    protected $fillable = [
        'user_id',
        'name',
        'lname',
        'email',
        'phone',
        'alt_contact',
        'city',
        'state',
        'country',
        'pincode',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'tracking_number',
        
    ];


}
