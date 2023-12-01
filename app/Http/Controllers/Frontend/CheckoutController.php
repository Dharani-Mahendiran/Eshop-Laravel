<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
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
        $order->user_id = Auth::id();
        $order->name = ucfirst($request->input('name'));
        $order->lname = ucfirst($request->input('lname'));
        $order->email = $request->input('email');
        $order->phone = $request->input('contact');
        $order->alt_contact = $request->input('alt_contact');
        $order->address = ucwords(strtolower($request->input('address')));
        $order->city = ucfirst($request->input('city'));
        $order->state = ucwords(strtolower($request->input('state')));
        $order->country = ucfirst($request->input('country'));
        $order->pincode = $request->input('pincode');


        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');


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
                'price' =>   $item->product_qty * $item->product->selling_price,
                'tracking_number' => $this->generateTrackingNumber(),
            ]);

            // Update product quantity, each time the product is ordered.
            $Product = Product::where('id', $item->product_id)->first();
            $Product->quantity = $Product->quantity - $item->product_qty;
            $Product->update();


        }

        if(Auth::user()->address == NULL){
            $user = User::where('id', Auth::id())->first();
            $user->lname = ucfirst($request->input('lname'));
            $user->phone = $request->input('contact');
            $user->alt_contact = $request->input('alt_contact');
            $user->address = ucwords(strtolower($request->input('address')));
            $user->city = ucfirst($request->input('city'));
            $user->state = ucwords(strtolower($request->input('state')));
            $user->address = ucwords(strtolower($request->input('address')));
            $user->country = ucfirst($request->input('country'));
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if($request->input('payment_mode') == 'Paid By Razorpay' || $request->input('payment_mode') == 'Paid By Paypal'){
            return response()->json(['message'=>'Order Placed Successfully']);
        }

        return redirect('/my-orders')->with('message', 'Order Placed Successfully');


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

    public function razorpaycheck(Request $request){

        $cart_items = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cart_items as $item){
            $total_price += $item->product_qty * $item->product->selling_price;
        }

        $name = $request->input('name');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $contact = $request->input('contact');
        $alt_contact = $request->input('alt_contact');
        $address = $request->input('address');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pincode = $request->input('pincode');

        return response()->json([

            'name' => $name,
            'lname' => $lname,
            'email' => $email,
            'contact' => $contact,
            'alt_contact' => $alt_contact,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pincode' => $pincode,
            'total_price' => $total_price

        ]);
    }






}
