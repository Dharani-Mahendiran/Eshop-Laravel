<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    protected $fillable = [
        'cate_id',
        'name',
        'slug',
        'description',
        'original_price',
        'selling_price',
        'image',
        'quantity',
        'status',
        'trending',
        'meta_title',
        'meta_keyword',
        'meta_description',
         
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }


}


