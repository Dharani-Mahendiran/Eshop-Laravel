<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $table ='ratings';
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'order-item_id',
        'ratings',
        'comments',
        'attachment-one',
        'attachment-two',
        'attachment-three',
    ];


    protected $attributes = [
        'comments' => '',
    ];

}
