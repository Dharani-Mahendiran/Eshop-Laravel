<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeorder(Request $request){

        $order = new Order();
        $order->name = $request->input('name');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('contact');
        $order->alt_contact = $request->input('alt_contact');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        // $order->status = $request->input('status');
        // $order->message = $request->input('message');
        
        // Using the generateTrackingNumber function
        $order->tracking_number = $this->generateTrackingNumber();
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_qty' => $item->product_qty,
                'price' => $item->product->selling_price,
            ]);
        }
        
        if(Auth::user()->address == NULL){
            $user = User::where('id', Auth::id())->first();
            $user->lname = $request->input('lname');
            $user->phone = $request->input('contact');
            $user->alt_contact = $request->input('alt_contact');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        return redirect('/')->with('message', 'Order Placed Successfully');
 
        
    }
    
    // Function to generate a tracking number
    private function generateTrackingNumber() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $trackingNumber = '';
        for ($i = 0; $i < 8; $i++) {
            $trackingNumber .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $trackingNumber;
    }
    
}