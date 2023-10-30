<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index(){
        $orders = OrderItem::where('status', '0')->get();
        $orderItem = OrderItem::where('status', '0')->get();
        return view('admin.orders.index', compact('orders','orderItem'));
    }

    public function orderdpacked(){
        $orderItem = OrderItem::where('status', '1')->get();
        return view('admin.orders.orderpacked', compact('orderItem'));
    }

    public function orderintransit(){
        $orderItem = OrderItem::where('status', '2')->get();
        return view('admin.orders.orderintransit', compact('orderItem'));
    }

    public function orderdelivered(){
        $orderItem = OrderItem::where('status', '3')->get();
        return view('admin.orders.orderdelivered', compact('orderItem'));
    }

    public function view(OrderItem $orderitem){
        $orders = Order::where('user_id', Auth::id())->get();
        $item = OrderItem::where('id', $orderitem->id)->first();
        $wishlist = Wishlist::all();
        return view('admin.orders.view', compact('orders','item','wishlist'));
    }


    public function updateorder(Request $request, $orderitem){

        $orderitem = OrderItem::findOrFail($orderitem);
        $orderitem->status = $request->input('order_status');
        $orderitem->save();

        return redirect('admin/order-view/'.$orderitem->id)->with('message', 'Order Status Updated');
    }












} 
