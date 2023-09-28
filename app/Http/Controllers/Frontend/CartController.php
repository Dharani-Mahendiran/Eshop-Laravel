<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){

         $product_id = $request->input('product_id');
         $product_qty = $request->input('product_qty');
         if(Auth::check()){
            $product_check = Product::where('id', $product_id)->first();
            if($product_check){
                $existingCartItem = Cart::where('product_id', $product_id)
                ->where('user_id', Auth::id())
                ->where('product_qty', '=', $product_qty)
                ->first();

                $updateCartItem = Cart::where('product_id', $product_id)
                ->where('user_id', Auth::id())
                ->where('product_qty', '!=', $product_qty)
                ->first();

                //  If there is already a product in the card with same id's
                if($existingCartItem){
                    return response()->json(['status' => $product_check->name.' already added to cart']);
                }
                elseif($updateCartItem) {
                    $cartItem = Cart::find($updateCartItem->id);
                    if ($cartItem) {
                        // Update the quantity of the existing cart item
                        $cartItem->product_qty = $product_qty;
                        $cartItem->update();
                        return response()->json(['status' => $product_check->name . ' Quantity Updated']);
                    }
                }
                else{
                // newly added products in the cart
                    $cartItem = new Cart();
                    $cartItem->user_id = Auth::id() ;
                    $cartItem->product_id = $product_id ;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $product_check->name.' added to cart']);
                }
            }
            else{
                return response()->json(['status' => 'Product Not Found']);
            }
         }
         else{
            return response()->json(['status' => 'Login To Continue']);
         }
    }
}
