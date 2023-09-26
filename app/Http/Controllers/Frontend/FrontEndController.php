<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    

    public function index(){


        $featured_products = Product::where([['trending', '1'],['status', '0'],])->take(15)->get();
        $popular_categories = Category::where([['popular', '1'],['status', '0'],])->take(15)->get();
        return view('frontend.index',compact('featured_products','popular_categories'));
    } 

    public function category(){

        $categories = Category::where('status', '0')->take(15)->get();
        return view('frontend.category',compact('categories'));
 
    }




}
