<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.myorder', compact('orders'));
    }
}
