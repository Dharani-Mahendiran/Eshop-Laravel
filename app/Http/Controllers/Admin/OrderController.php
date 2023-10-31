<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Exceptions\InvalidFormatException;

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


   public function updateorder(Request $request, $orderId)
    {

    try {
        $orderItem = OrderItem::findOrFail($orderId);
        $orderItem->status = $request->input('order_status');
        if ($orderItem->status == 1) {
            $orderItem->dispatched_date = $request->has('dispatched_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('dispatched_date'))->format('Y-m-d') : null;
        } elseif ($orderItem->status == 2) {
            $orderItem->intransit_date = $request->has('intransit_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('intransit_date'))->format('Y-m-d') : null;
        } elseif ($orderItem->status == 3) {
            $orderItem->delivered_date = $request->has('delivered_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('delivered_date'))->format('Y-m-d') : null;
        }

        $orderItem->save();
        return redirect('admin/order-view/'.$orderItem->id)->with('message', 'Order Status Updated');
    } catch (InvalidFormatException $e) {
        return redirect()->back()->withInput()->withErrors(['error' => 'Invalid date format: ' . $e->getMessage()]);
    } catch (\Exception $e) {
        // Log any other exceptions here for debugging
        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the order: ' . $e->getMessage()]);
    }

    }



    public function updateDeliveryDate(Request $request, $orderId) {
        $orderItem = OrderItem::findOrFail($orderId);
    

        $dispatchedDate = $orderItem->dispatched_date;
        $inTransitDate = $orderItem->intransit_date;
        $deliveredDate = $orderItem->delivered_date;
    

        $orderItem->dispatched_date = $request->has('edit_dispatched_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('edit_dispatched_date'))->format('Y-m-d') : $dispatchedDate;
        $orderItem->intransit_date = $request->has('edit_intransit_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('edit_intransit_date'))->format('Y-m-d') : $inTransitDate;
        $orderItem->delivered_date = $request->has('edit_delivered_date') ? Carbon::createFromFormat('l, d F, Y', $request->input('edit_delivered_date'))->format('Y-m-d') : $deliveredDate;
    
        $orderItem->update();
    
        return redirect('admin/order-view/'.$orderItem->id)->with('message', 'Order Status Updated Successfully');
    }
    


} 