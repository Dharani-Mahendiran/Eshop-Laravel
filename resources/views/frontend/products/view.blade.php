@extends('layouts.frontend')


@section('title'){{ $product->name }}@endsection
@section('body_class', 'home-index product-view')
@section('content')

<div class="breadcrumb">
  <h4>Collection/{{ $product->category->name }}/{{ $product->name }}</h4>
</div>


<div class="section-bg productData">
<div class="container-fluid">
<div class="row ui">

    <div class="col-md-4">
        <i class='product-i'>
            <img src="{{ asset('uploads/product/'.$product->image)}}" alt={{ $product->name  }}>
        </i>
    </div>

    <div class="col-md-8 content">
        <div class='product-box'>
            <h4>{{ $product->name }}</h4>
           
            <h6 class="">
              @if($product->trending == 1)
                <span class='trending'>Trending</span>
              @endif
              <i class='fa fa-heart' id='commonlist' title='Add to Wish list'></i>
              <i class='fa fa-heart text-danger' id='wishlist' title='Remove from wish list'></i>
            </h6>
          
        </div>


        <div class="price-box">
            <span>M.R.P <s class='text-danger'>₹ {{ $product->original_price }}</s></span>
            <span class='text-success ms-2'>₹ {{ $product->selling_price }}</span>
        </div>

        <div class="feature-box">
            <h5> Description About this product:- </h5>
            <p>{{ $product->description }}</p>
        </div>



        @if($product->quantity > 0)
        <span class='stock-in'>In Stock</span>
        <div class="cart">
            <div class="add-quantity">
                <button class="minus" aria-label="Decrease">&minus;</button>
                <input type="number" name='quantity' class="qty-input" value="1">
                <button class="plus" aria-label="Increase">&plus;</button>
            </div>

        <form action="">
            <button class="btn buy-btn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Buy Now
            </button>

            <input type="hidden" value='{{ $product->id }}' class='product_id'>
            <button class="btn cart-btn addToCartBtn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Add To Cart
            </button>
        </form>
        </div>
        @else
        <div class='notify'>
        <span class='stock-out'>Oops! This product is currently out of stock</span>
        <i class='fa fa-bell ms-2' id='notify' title='Notify product'></i>
        <i class='fa fa-bell ms-2' id='notified' title='Remove from notify'></i>
        </div>
        @endif



    </div>
                       
</div>               
</div>
</div>


@endsection