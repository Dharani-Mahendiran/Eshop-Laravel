@extends('layouts.admin')

@section('title') Order View  @endsection
@section('body_class', 'orderview')
@section('content')

<div class="breadcrumb d-md-flex justify-content-between align-items-center d-block">
    <h4 class='mb-3 mb-md-0'>Order/{{ $item->product->name }}</h4>
    <button class='goBk-btn'>Go Back</button>
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
                                        <span class='trending me-2'>Trending</span>
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
                <div class="card-header d-flex justify-content-between bg-danger text-white">
                    <h5>Update Status</h5>
                </div>
                <div class="card-body">
                    

                <form action="{{ url('admin/order-update/'.$item->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                <div class='row col-12'>

                    <div class="form-group col-md-6">
                    <label for="">Choose Status</label>
                    <select class="form-select" name="order_status">
                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Order Placed</option>
                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Item Packed</option>
                        <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>In Transit</option>
                        <option value="3" {{ $item->status == 3 ? 'selected' : '' }}>Delivered</option>
                    </select>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="">Delivery Date</label>
                    <input type="text" id="datepicker" size="30" class='form-control' name='delivery_date' value='{{ \Carbon\Carbon::parse($item->delivery_date)->format("l, d F, Y") }}'>
                    </div>
                    

                </div>

                    <button class='btn btn-danger mt-3 float-end'>Update</button>

                </form>
                    
                </div>
            </div>

            </div>
            </div>
        
      

        </div>
    </div>
</div>

@endsection

