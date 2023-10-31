@extends('layouts.frontend')


@section('title') Order View  @endsection
@section('body_class', 'orderview')
@section('content')

<div class="breadcrumb d-md-flex justify-content-between align-items-center d-block">
    <h4 class='mb-3 mb-md-0'>Order/{{ $item->product->name }}</h4>
    <button class='goBk-btn'>Go Back</button>
</div>

<div class="section-bg productData theme-bg p-lg-5 p-md-3">
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
                <a href="{{ url('category/'.$item->product->category->slug.'/'.$item->product->slug) }}" class="btn buy-btn bg-warning">
                    <i class="fa fa-shopping-cart text-white">  Re-Order Product?</i> 
                </a>
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
                        
                                    @if($wishlist->where('user_id', Auth::id())->where('product_id', $item->product->id)->count() > 0)
                                        <i class='fa fa-heart text-danger wishlist cursor-pointer' data-wishlist-state="1" title='Remove from wish list'></i>
                                    @else
                                        <i class='fa fa-heart text-grey commonlist cursor-pointer' data-wishlist-state="0" title='Add to Wish list'></i>
                                    @endif
                                
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
                    <div class="card-header d-flex justify-content-between">
                        <h5>Order Status</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="progress">
                            <div class="dot dot1"></div>
                            <div class="dot dot2"></div>
                            <div class="dot dot3"></div>
                            <div class="dot dot4"></div>
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        <div class="steps">
                            <div class="step-item active" id="orderPlaced">Order Placed
                                <i class='d-block'>{{ \Carbon\Carbon::parse($item->created_at)->format("l, d F, Y") }}</i>
                            </div>
                            <div class="step-item" id="dispatched">Dispatched
                                @if($item->dispatched_date != null)
                                <i class='d-block'>
                                {{ \Carbon\Carbon::parse($item->dispatched_date)->format("l, d F, Y") }}
                                </i>
                                @endif
                            </div>
                            <div class="step-item" id="inTransit">In Transit
                                @if($item->intransit_date != null)
                                <i class='d-block'>
                                {{ \Carbon\Carbon::parse($item->intransit_date)->format("l, d F, Y") }}
                                </i>
                                @endif
                            </div>
                            <div class="step-item" id="delivered">Delivered
                                @if($item->delivered_date != null)
                                <i class='d-block'>
                                {{ \Carbon\Carbon::parse($item->delivered_date)->format("l, d F, Y") }}
                                </i>
                                @endif
                            </div>
                        </div>

                    </div>
            </div>

            </div>

           
        
      

        </div>
    </div>
</div>

<script>
    const item = { status: {{$item->status}} }; 
    const progress = document.querySelector('.progress-bar');
    const stepItems = document.querySelectorAll('.step-item');
    const stepWidth = 100 / (stepItems.length - 1);
    const progressWidth = (item.status * stepWidth);
    
    // progress.style.width = `${progressWidth}%`;

    if (item.status === 0) {
        progress.style.width = `13%`;
    } else if (item.status === 1) {
        progress.style.width = `38%`;
    } else if (item.status === 2) {
        progress.style.width = `63%`;
    } else if (item.status === 3) {
        progress.style.width = `100%`;
    }

    for (let i = 0; i <= item.status; i++) {
        stepItems[i].classList.add('active');
    }


// Dot Position
window.addEventListener('resize', positionDots);

function positionDots() {
    const stepItems = document.querySelectorAll('.step-item');
    const dots = document.querySelectorAll('.dot');
    
    stepItems.forEach((step, index) => {
        const stepPosition = step.offsetLeft + step.offsetWidth / 2;
        dots[index].style.left = stepPosition + 'px';
    });
}

positionDots();

</script>


@endsection