<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $orders = Order::where('user_id', Auth::id())->get();
        $orderItems = [];
    
        foreach ($orders as $order) {
            $orderItems[$order->id] = OrderItem::where('order_id', $order->id)->get();
        }
    
        return view('frontend.myorder', compact('orders', 'orderItems'));
    }


    public function view(OrderItem $orderitem){
        $orders = Order::where('user_id', Auth::id())->get();
        $item = OrderItem::where('id', $orderitem->id)->first();
        $wishlist = Wishlist::all();
        return view('frontend.myorderview', compact('item','wishlist'));
    }
    
    
}
