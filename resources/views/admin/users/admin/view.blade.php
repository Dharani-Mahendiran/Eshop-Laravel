@extends('layouts.admin')
@section('title')
@if ($user->role_as == 0)
User Profile
@elseif ($user->role_as == 1)
Admin Profile
@endif
@endsection
@section('body_class', 'myorder')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header theme-bg">
                    <h4 class="d-flex align-items-center justify-content-between mb-0">
                         @if ($user->role_as == 0)
                             User Profile
                         @elseif ($user->role_as == 1)
                             Admin Profile
                         @endif
                        <a href="{{ url('admin/profiles') }}" class="btn btn-sm btn-danger text-light">Go Back</a>
                    </h4>
                </div>

                    <div class="card-body d-block">
                        <form>
                        
                            <div class="row col-12">

                                <div class="col-md-6 mb-3">
                                <label for="name" class="">First Name</label>
                                <p class="form-control">{{ $user->name }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="lname" class="">Last Name</label>
                                <p class="form-control">{{ $user->lname }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="email" class="">Email</label>>
                                <p class="form-control">{{ $user->email }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="phone" class="">Phone</label>
                                <p class="form-control">{{ $user->phone }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="alt_contact" class="d">Alternative Contact</label>
                                <p class="form-control">{{ $user->alt_contact }}</p>
                                </div>

                                {{-- <div class="col-md-6 mb-3 form-group">
                                    <label for="password" class="">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control" type="password" value="{{ $user->password }}" id="password_field">
                                        <div class="input-group-addon">
                                            <button onclick="togglePassword()" type="button" class="btn btn-default" id="toggle_password_button"><i class="mdi mdi-eye-off" aria-hidden="true"></i></button>
                                        </div>
                                    </div> 
                                </div> --}}

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="">Role</label>
                                    <p class="form-control">{{ $user->role_as=='0'?'User':'Admin' }}</p>
                                </div>

                    
                                <div class="col-12">
                                <button type='button' class="btn btn-primary text-light float-end update_user" onclick="update_user()">Create</button>
                                </div>

                            </div>
                        </form>
                    </div>

            </div>
        </div>



    @if($user->role_as == 0)

    <div class="card p-0">
  
        <div class="card-header theme-bg">
            <h3>Orders</h3>
        </div>
        @if(count($orders) > 0)
        @foreach ($orders  as $order)
            @foreach ($orderItems[$order->id] as $item)
        
        
            <a href="{{ url('admin/order-view/'.$item->id) }}" class='text-decoration-none cursor-pointer'>
                <div class="card-body row m-0 p-2">
                    <div class='col-md-12' >
                        {{-- <i>{{ $order->id }}</i> --}}
                        <i class='card-img'>
                            <img class="card-img-top" src="{{ url('uploads/product/'.$item->product->image) }}" alt="Product image" width>
                        </i>
        
                    <div class='d-block'>
                    <h4 class="">{{ $item->product->name }}</h4>
        
                    @if ($item->status == '0')
                    <div class="d-flex align-items-center">
                        <h4 class='me-2'><i class='text-secondary'>Order Placed </i></h4>
                        <h6 class='m-0'><i class='text-secondary'> on {{ $item->created_at }} </i></h6>
                    </div> 
        
                    @elseif ($item->status == '1')
                    <div class="d-flex align-items-center">
                        <h4 class='me-2'><i class='text-secondary'>Item Dispatched</i></h4>
                        @if($item->dispatched_date != null)
                        <h6 class='m-0'><i class='text-secondary'> on {{ $item->dispatched_date }} </i></h6>
                        @endif
                    </div> 
                    
                    @elseif ($item->status == '2')
                    <div class="d-flex align-items-center">
                        <h4 class='me-2'><i class='text-secondary'>In-Transit</i></h4>
                        @if($item->intransit_date != null)
                        <h6 class='m-0'><i class='text-secondary'> on {{ $item->intransit_date}} </i></h6>
                        @endif
                    </div>
        
        
                    @elseif ($item->status == '3')
        
                        <div class="d-flex align-items-center">
                            <h4 class='me-2' ><i class='text-success d-block'>Delivered</i></h4>
                            @if($item->delivered_date != null)
                            <h6 class='m-0'><i class='text-success'> on {{ $item->delivered_date }} </i></h6>
                            @endif
                        </div> 
                            <span class='ratings'>
                                <i class='text-warning wrap'>Product Ratings</i>
                                <ul>
                                    <li><i class='mdi mdi-star'></i></li>
                                    <li><i class='mdi mdi-star'></i></li>
                                    <li><i class='mdi mdi-star'></i></li>
                                    <li><i class='mdi mdi-star'></i></li>
                                    <li><i class='mdi mdi-star'></i></li>
                                </ul>
                            </span>
                        
                        @endif
                        
        
                        </div>
        
        
                            <i class="mdi mdi-chevron-right" title="View Order"></i>
                      
        
                    </div>
                </div>
            </a>
        
                <hr class="wrap m-0">
            @endforeach
        @endforeach
        
        
        
        @else
        
                <div class="card-body d-block">
        
                    <h4 class='text-danger text-center m-4'><i class="fa fa-shopping-cart"></i> 
                        No Orders Yet!
                    </h4>

                </div>
        @endif
        
        
        
        </div>



    @endif















    </div>
</div>



@endsection
