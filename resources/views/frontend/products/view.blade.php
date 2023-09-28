@extends('layouts.frontend')


@section('title'){{ $product->name }}@endsection
@section('body_class', 'home-index product-view')
@section('content')

<div class="breadcrumb">
  <h4>Collection/{{ $product->category->name }}/{{ $product->name }}</h4>
</div>


<div class="section-bg">
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
                <i class='fa fa-heart' id='commonlist'></i>
                <i class='fa fa-heart text-danger' id='wishlist'></i>
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

            <button class="btn cart-btn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Add To Cart
            </button>
        </form>
        </div>
        @else
        <div class='notify'>
        <span class='stock-out'>Oops! This product is currently out of stock</span>
        <i class='fa fa-bell ms-2' id='notify'></i>
        <i class='fa fa-bell ms-2' id='notified'></i>
        </div>
        @endif



    </div>
                       
</div>               
</div>
</div>

@section('scripts')
<script>

// add and decrease quantity
$(document).ready(function () {
  $('.plus').click(function (e) { 
    e.preventDefault();

    var inc_val = $('.qty-input').val();
    var value = parseInt(inc_val, 10);

    // Use isNaN to check if it's Not A Number
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
      value++;
      $('.qty-input').val(value);
    }
  });


  $('.minus').click(function (e) { 
    e.preventDefault();

    var dec_val = $('.qty-input').val();
    var value = parseInt(dec_val, 10);

    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      $('.qty-input').val(value);
    }
  });

    // if the user type more than 10, enforce the inpiut val to max 10
    $('.qty-input').on('input', function () {
    var value = parseInt($(this).val(), 10);

    if (isNaN(value) || value < 1) {
      $(this).val(1);
    } else if (value > 10) {
      $(this).val(10);
    }
  });

});

document.addEventListener('DOMContentLoaded', function () {
// Wishlist icon toggle
  const commonlistIcon = document.getElementById('commonlist');
  const wishlistIcon = document.getElementById('wishlist');
  commonlistIcon.addEventListener('click', () => {
      commonlistIcon.style.display = 'none';
      wishlistIcon.style.display = 'inline-block';
  });

  wishlistIcon.addEventListener('click', () => {
      wishlistIcon.style.display = 'none';
      commonlistIcon.style.display = 'inline-block';
  });

// Notify icon toggle
  const notifyIcon = document.getElementById('notify');
  const notifiedIcon = document.getElementById('notified');
  notifyIcon .addEventListener('click', () => {
    notifyIcon .style.display = 'none';
    notifiedIcon .style.display = 'inline-block';
  });

  notifiedIcon .addEventListener('click', () => {
    notifiedIcon .style.display = 'none';
    notifyIcon .style.display = 'inline-block';
  });

});


</script>
@endsection

@endsection