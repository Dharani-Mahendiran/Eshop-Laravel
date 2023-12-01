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

          @if($wishlist->where('user_id', Auth::id())->where('product_id', $product->id)->count() > 0)
              <i class='fa fa-heart text-danger wishlist cursor-pointer' data-wishlist-state="1" title='Remove from wish list'></i>
          @else
              <i class='fa fa-heart text-grey commonlist cursor-pointer' data-wishlist-state="0" title='Add to Wish list'></i>
          @endif

            </h6>

        </div>


        <div class="price-box">
            <span>M.R.P <s class='text-danger'>₹ {{ $product->original_price }}</s></span>
            <span class='text-success ms-2'>₹ {{ $product->selling_price }}</span>
        </div>

        <div class="feature-box mb-0">
            <h5> Description About this product:- </h5>
            <p class='mb-0'>{{ $product->description }}</p>
        </div>


        <div class="rating-css">
            <div class="star-icon">
                <input type="radio" value="1" name="product_rating" checked id="rating1">
                <label for="rating1" class="fa fa-star"></label>
                <input type="radio" value="2" name="product_rating" id="rating2">
                <label for="rating2" class="fa fa-star"></label>
                <input type="radio" value="3" name="product_rating" id="rating3">
                <label for="rating3" class="fa fa-star"></label>
                <input type="radio" value="4" name="product_rating" id="rating4">
                <label for="rating4" class="fa fa-star"></label>
                <input type="radio" value="5" name="product_rating" id="rating5">
                <label for="rating5" class="fa fa-star"></label>
            </div>
        </div>


        <input type="hidden" value='{{ $product->id }}' class='product_id'>
        @if($product->quantity > 0)
        <span class='stock-in'>In Stock</span>
        <div class="cart">
            <div class="add-quantity">
                <button class="minus" aria-label="Decrease">&minus;</button>
            @if($cart->where('user_id', Auth::id())->where('product_id', $product->id)->count() > 0)
            @foreach($cart as $cartItem)
                @if($cartItem->user_id == Auth::id() && $cartItem->product_id == $product->id)
                    <input type="number" name='quantity' class="qty-input" value='{{ $cartItem->product_qty }}'>
                @endif
            @endforeach
            @else
                <input type="number" name='quantity' class="qty-input" value="1">
            @endif

                <button class="plus" aria-label="Increase">&plus;</button>
            </div>

        <form action="">
            <button class="btn buy-btn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Buy Now
            </button>


            <button class="btn cart-btn addToCartBtn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Add To Cart
            </button>
        </form>
        </div>
        @else
        <div class='notify'>
        <span class='stock-out'>Oops! This product is currently out of stock</span>
        <i class='fa fa-bell ms-2 notify-bell cursor-pointer' title='Notify product'></i>
        <i class='fa fa-bell ms-2 notified cursor-pointer' title='Remove from notify'></i>
        </div>
        @endif



    </div>

</div>
</div>
</div>


@endsection
