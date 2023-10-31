@extends('layouts.admin')

@section('title') Order View  @endsection
@section('body_class', 'orderview')
@section('content')

<div class="breadcrumb d-md-flex justify-content-between align-items-center d-block">
    <h4 class='mb-3 mb-md-0'>Order/{{ $item->product->name }}</h4>
    <a href="{{url('admin/orders')}}" class='btn btn-sm btn-danger  text-light'>Go Back</a>
</div>

<div class="section-bg productData theme-bg p-lg-5 p-md-3 py-2">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-5">
                <div class="card p-0">
                    <div class="card-header">
                        <h5>Basic Details</h5>
                    </div>
                    <div class="card-body row col-12 productData cursor-pointer">
                  
                            <div class="row form-wrap mb-3">
                                <div class="col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" value={{ $item->order->name }} placeholder="Enter First Name" name="name">
                                    <span id="name-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" value={{ $item->order->lname }} placeholder="Enter Last Name" name="lname">
                                    <span id="lname-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value={{ $item->order->email }} placeholder="Enter Email" name="email">
                                    <span id="email-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="number" class="form-control" value={{ $item->order->phone }} placeholder="Enter Phone Number" name="contact">
                                    <span id="contact-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Alternative Contact</label>
                                    <input type="number" class="form-control" value="{{ $item->order->alt_contact ? $item->order->alt_contact : '' }}" placeholder="{{ !$item->order->alt_contact ? 'NULL' : 'Enter Alternative Contact' }}" name="alt_contact">
                                    <span id="altcontact-error" class="text-danger"></span>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" value="39/45" placeholder="Enter Address" name="address">
                                    <span id="address-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" value="Coimbatore" placeholder="Enter City" name="city">
                                    <span id="city-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" value="Tamil" nadu="" placeholder="Enter State" name="state">
                                    <span id="state-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" value="India" placeholder="Enter Country" name="country">
                                    <span id="country-error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Pincode</label>
                                    <input type="number" class="form-control" value="641020" placeholder="Enter Pincode" name="pincode">
                                    <span id="pincode-error" class="text-danger"></span>
                                </div>
    
                            </div>

    
                    </div>
                </div>
            </div>
    
            <div class="col-md-7">
            <div class="col-md-12">
                <div class="card p-0">
                <div class="card-header d-flex justify-content-between">
                <h5>Order Details</h5>
                </div>
                
                                        
                <div class="card-body pricing">

                    <div class="row">
                     
                            <div class="col-md-4">
                                <i class='product-i'>
                                    <img src="{{ asset('uploads/product/'.$item->product->image)}}" alt={{ $item->product->name  }}>
                                </i>
                            </div>
                
                
                            <div class="col-md-8 content">
                
                            <div class='py-2 d-flex justify-content-between'> 
                                <h4 class='m-0'>
                                    <i class='text-warning'><strong>Order Id : {{ $item->tracking_number }}</strong></i>
                                </h4>

                                
                                <h4 class='m-0 d-flex align-items-center'>
                                    <i class='fa fa-download cursor-pointer text-success me-2' title="Download Invoice"></i>
                                    @if($item->product->trending == 1)
                                        <span class='trending me-2'>#Trending</span>
                                    @endif
                        
                                    {{-- @if($wishlist->where('user_id', Auth::id())->where('product_id', $item->product->id)->count() > 0)
                                        <i class='fa fa-heart text-danger wishlist cursor-pointer' data-wishlist-state="1" title='Remove from wish list'></i>
                                    @else
                                        <i class='fa fa-heart text-grey commonlist cursor-pointer' data-wishlist-state="0" title='Add to Wish list'></i>
                                    @endif --}}
                                
                                </h4>

                            </div>
                
        
                              <div class="table-orders">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-white">
                                            <td>{{ $item->product->name }}</td>
                                            <td>₹ {{ $item->product->selling_price }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                              
                        
                        
                                <input type="hidden" value='{{ $item->product->id }}' class='product_id'>
                

                                <h4 class='text-end'>
                                    <b>Grand Total  </b> <span class="text-success"><b>₹ {{ $item->price }}</b></span>
                                </h4>

                              

                        </div>
                    </div>

                </div>
                         
                </div>
    
            </div>
            <div class="col-md-12 mt-lg-3">
                <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center bg-danger text-white">
                    <h5 class='m-0'>Update Status</h5>
                    
                    @if($item->status == 0)
                    <h5 class='bg-success m-0 p-2'>Order Placed</h5>
                    @elseif($item->status == 1)
                    <h5 class='bg-info m-0 p-2'>Item Dispatched</h5>
                    @elseif($item->status == 2)
                    <h5 class='bg-warning m-0 p-2'>In Transit</h5>
                    @elseif($item->status == 3)
                    <h5 class='bg-success m-0 p-2'>Delivered</h5>
                    @endif

                </div>
                <div class="card-body">
                    

                    <form action="{{ url('admin/order-update/'.$item->id) }}" method="POST" id="updateForm">
                        @csrf
                        @method('POST')
                    
                        <div class='row col-12'>
                            <div class="form-group col-md-5">
                                <label for="">Update Status</label>
                                <select class="form-select" name="order_status" id="order_status" onclick="change_status()">
                                    <option value=""  {{ $item->status == 0 ? 'selected' : '' }}>Choose Status</option>
                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Item Dispatched</option>
                                    <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>In Transit</option>
                                    <option value="3" {{ $item->status == 3 ? 'selected' : '' }}>Delivered</option>
                                </select>
                            </div>
                    
                            
                                <div class='dispatch form-group col-md-5' style="display: none;">
                                    <label for="">Dispatch Date</label>
                                    <input type="text" size="30" class='datepicker form-control' name='dispatched_date' @if($item->dispatched_date != null)value='{{ \Carbon\Carbon::parse($item->dispatched_date)->format("l, d F, Y") }}' @endif>
                                </div>
                    
                                <div class='intransit form-group col-md-5' style="display: none;">
                                    <label for="">In-Transit Date</label>
                                    <input type="text" size="30" class='datepicker form-control' name='intransit_date' @if($item->intransit_date != null)value='{{ \Carbon\Carbon::parse($item->intransit_date)->format("l, d F, Y") }}' @endif>
                                </div>
                    
                                <div class='delivery form-group col-md-5' style="display: none;">
                                    <label for="">Delivery Date</label>
                                    <input type="text" size="30" class='datepicker form-control' name='delivered_date' @if($item->delivered_date != null)value='{{ \Carbon\Carbon::parse($item->delivered_date)->format("l, d F, Y") }}' @endif>
                                </div>
                           
            

                    <div class='form-group col-md-2 d-flex align-items-end justify-content-center'>
                        <button class='btn btn-danger float-end'>Save</button>
                    </div>
                
                </div>
                    
                </form>


                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 my-3 action-wrap">
                    <h5 class='m-0'>Edit Status</h5>
                </div>
                    
                <form action="{{ url('admin/order-updateDate/'.$item->id) }}" method="POST" id="updateDateForm">
                @csrf
                @method('PUT')
                <div class="row col-12">
                    <div class="form-group col-md-4">
                        <label for="">Placed On</label>
                        <h6 class='form-control'>{{ \Carbon\Carbon::parse($item->created_at)->format("l, d F, Y") }}</h6>
                    </div>

                    @if(in_array($item->status, [1, 2, 3])) 
                    <div class="form-group col-md-4">
                        <label for="">Dispacted On</label>
                        <input type="text" size="30" class='datepicker form-control' name='edit_dispatched_date' @if($item->dispatched_date != null)value='{{ \Carbon\Carbon::parse($item->dispatched_date)->format("l, d F, Y") }}' @endif>
                    </div>
                    @endif

                    @if(in_array($item->status, [2, 3])) 
                    <div class="form-group col-md-4">
                        <label for="">In-Transit On</label>
                        <input type="text" size="30" class='datepicker form-control' name='edit_intransit_date' @if($item->intransit_date != null)value='{{ \Carbon\Carbon::parse($item->intransit_date)->format("l, d F, Y") }}' @endif>
                    </div>
                    @endif

                    @if($item->status == 3)
                    <div class="form-group col-md-4">
                        <label for="">Delivered On</label>
                        <input type="text" size="30" class='datepicker form-control' name='edit_delivered_date' @if($item->delivered_date != null)value='{{ \Carbon\Carbon::parse($item->delivered_date)->format("l, d F, Y") }}' @endif>
                    </div>
                    @endif

                    <div class='form-group col-md-12 float-end'>
                        <button class='btn btn-primary float-end text-light'>Update</button>
                    </div>
                </div>
                </form>

    
                </div>
            </div>

            </div>
            </div>
        
      

        </div>
    </div>
</div>






@endsection


