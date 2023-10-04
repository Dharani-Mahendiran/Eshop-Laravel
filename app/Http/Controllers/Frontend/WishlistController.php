<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        if(Auth::check()){
           $product_check = Product::where('id', $product_id)->first();

           $existingListItem =  Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();
           
           if($product_check){
                   $WisListItem = new Wishlist();
                   $WisListItem->user_id = Auth::id() ;
                   $WisListItem->product_id = $product_id ;
                   $WisListItem->save();
                   return response()->json(['status' => $product_check->name.' added to wish list']); 
           }
           else{
               return response()->json(['status' => 'Product Not Found']);
           }
        }
        else{
           return response()->json(['status' => 'Login To Continue']);
        }
   }

    public function viewWishlist(){
        $wishListItems = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishListItems'));
    }



    public function deleteProduct(Request $request){

        $product_id = $request->input('product_id');
        $product_check = Product::where('id', $product_id)->first();
        
        if(Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
           $cartItem =  Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();
           $cartItem->delete();
           return response()->json(['status' => $product_check->name.' removed from wish list.']);
        }
        else{
            return response()->json(['status' => 'Product Not Found']);
        }

    }


}
