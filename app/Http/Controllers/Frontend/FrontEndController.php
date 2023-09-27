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


    public function viewcategory($slug){
        
        if(Category::where('slug', $slug)->exists()){

            $category = Category::where('slug', $slug)->first();
            $products =  Product::where('cate_id', $category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));
        }
        else{
            return redirect('/category')->with('error','No category found');
        }

    }


    public function viewproduct($cate_slug, $prod_slug){
        if(Category::where('slug', $cate_slug)->exists()){

            if(Product::where('slug', $prod_slug)->exists()){

                $product =Product::where('slug', $prod_slug)->first();

                return view('frontend.products.view',compact('product'));
            }
            else{
                return redirect('view-category/'.$cate_slug)->with('error','No product Found.');
            }

           
        }
        else{
            return redirect('/category')->with('error','No category found.');
        }
    }




}
