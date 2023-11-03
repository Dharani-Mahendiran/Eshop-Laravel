<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    
    public function users(){
        $users = User::where(['role_as' => '0', 'has_deleted' => '0'])->get();
        return view('admin.users.index', compact('users'));
    }
    
    public function adminProfiles(){
        $users = User::where(['role_as' => '1', 'has_deleted' => '0'])->get();
        return view('admin.users.admin.index', compact('users'));
    }
    

    public function create_user(){

        return view ('admin.users.create');
    }


    public function store_user(Request $request){

        $user = new User;
        $user->name = $request->input('name');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->alt_contact = $request->input('alt_contact');

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $user->password = $hashedPassword;
        
        $user->role_as = $request->input('role_as');
        $user->save();

        if($user->role_as == 0){
            return redirect('admin/users')->with('message', 'User Created Successfully');
        }
        elseif($user->role_as == 1){
            return redirect('admin/profiles')->with('message', 'Admin Profile Created');
        }
        else{
            return redirect('admin/users')->with('warning', 'Error Occurred');
        }
    }

    public function view_user(User $user){
        $user = User::where('id', $user->id)->first();

        $orders = Order::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();

        $orderItems = [];
    
        foreach ($orders as $order) {
            $orderItems[$order->id] = OrderItem::where('order_id', $order->id)->get();
        }


        return view('admin.users.admin.view', compact('user','orders','orderItems'));
    }


    public function edit_user(User $user){

            $user = User::where('id', $user->id)->first();
            return view('admin.users.admin.edit', compact('user'));
    }



    public function update_user(Request $request, $user){

        $user = User::findOrFail($user);

        $user->name = $request->input('name');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->alt_contact = $request->input('alt_contact');
        $user->password = $request->input('password');

        $user->Update();

    
        return redirect('admin/profiles')->with('message', 'Admin Profile Created');

    }

    public function remove_user($user){
        
        $user = User::findOrFail($user);
        $user->has_deleted = '1';
        $user->update();
        return redirect('admin/profiles')->with('message', 'Admin Profile Removed');
    }
    


}
