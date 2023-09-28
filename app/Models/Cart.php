<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
    ];


    public function carts() { 
        return $this->hasMany(Product::class, 'product_id', 'id')->hasMany(User::class, 'user_id', 'id');
    }
    

}
