@extends('layouts.frontend')


@section('title') Order View  @endsection
@section('body_class', 'home-index product-view orderview')
@section('content')

<div class="breadcrumb d-flex justify-content-between align-items-center">
    <h4 class=''>Order/{{ $item->product->name }}</h4>
    <button class='goBk-btn'>Go Back</button>
</div>

<div class="section-bg productData">
    <div class="container-fluid">
        <div class="row ui">


            <div class="col-md-4">
                <i class='product-i'>
                    <img src="{{ asset('uploads/product/'.$item->product->image)}}" alt={{ $item->product->name  }}>
                </i>
            </div>


            <div class="col-md-8 content">


                <h4 class='py-2 d-flex justify-content-between'>
                    <i class='text-warning'><strong>Order Id : {{ $item->tracking_number }}</strong></i>

                    <i class='fa fa-download cursor-pointer text-success' title="Download Invoice"></i>
                
                </h4>


                <div class='product-box'>
                    <h4>{{ $item->product->name }}</h4>
                   
                    <h6 class="">
                      @if($item->product->trending == 1)
                        <span class='trending'>Trending</span>
                      @endif
        
                  @if($wishlist->where('user_id', Auth::id())->where('product_id', $item->product->id)->count() > 0)
                      <i class='fa fa-heart text-danger wishlist cursor-pointer' data-wishlist-state="1" title='Remove from wish list'></i>
                  @else
                      <i class='fa fa-heart text-grey commonlist cursor-pointer' data-wishlist-state="0" title='Add to Wish list'></i>
                  @endif
        
                    </h6>
                  
                </div>
        
        
                <div class="price-box">
                    <span>M.R.P <s class='text-danger'>₹ {{ $item->product->original_price }}</s></span>
                    <span class='text-success ms-2'>₹ {{ $item->product->selling_price }}</span>
                </div>
        
                <div class="feature-box">
                    <h5> Description About this product:- </h5>
                    <p>{{ $item->product->description }}</p>
                </div>
        
        
                <input type="hidden" value='{{ $item->product->id }}' class='product_id'>

                <div class="cart">
                <form action="">
                    <button class="btn buy-btn bg-danger" tabindex="0">
                        <i class="fa fa-shopping-cart "></i> Re-Order Product?
                    </button>
                </form>
                </div>

        
        
        
            </div>



        </div>
    </div>
</div>

@endsection