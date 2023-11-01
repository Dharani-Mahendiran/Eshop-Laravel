<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    
    public function users(){
        $users = User::where('role_as', '0')->get();
        return view ('admin.users.index', compact('users'));
    }


}
