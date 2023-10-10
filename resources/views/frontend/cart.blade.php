@extends('layouts.frontend')


@section('title') My Cart @endsection
@section('body_class', 'mycart')
@section('content')


<div class="breadcrumb">
    <h4>Home/Cart</h4>
</div>

<div class="container">
    

<div class="row">

@if(count($cartItems) > 0)

<div class="col-md-8">
<div class="card p-0">
    <div class="card-header">
        <h5>Cart Items<span> ({{ count($cartItems) }}) </span></h5>
    </div>

    @php 
    $total= 0;
    $num = 1;
    @endphp

    @foreach($cartItems as $index =>$item)
    <input type="hidden" value='{{ $item->id }}' class='cart_id'>

    <a href="{{ url('category/'.$products[$index]->category->slug.'/'.$products[$index]->slug) }}" class="text-decoration-none color-inherit">
    
    <div class="card-body row col-12 productData  cursor-pointer">
        <div class='cart-img col-md-2'>
            <i>
            <img src="{{ asset('uploads/product/'.$item->product->image)}}" alt={{ $item->product->name  }}>
            </i>
        </div>

        <div  class='cart-body col-md-10'>
            <h5 class='wrap'> 
                <p>{{-- $num++ --}} {{ $item->product->name }}</p>
                <input type="hidden" value='{{ $item->product_id }}' class='product_id'>
                <div class="add-quantity">
                    <button class="minus changeQuantity" aria-label="Decrease">&minus;</button>
                    <input type="number" name='quantity' class="qty-input" value='{{ $item->product_qty }}'>
                    <button class="plus changeQuantity" aria-label="Increase">&plus;</button>

                    @if($wishlist->where('user_id', Auth::id())->where('product_id', $item->product->id)->count() > 0)
                    <i class='fa fa-heart text-danger wishlist cursor-pointer border-0' data-wishlist-state="1" title='Remove from wish list'>
                    </i>
                    @else
                        <i class='fa fa-heart text-grey commonlist cursor-pointer' data-wishlist-state="0" title='Add to Wish list'>
                        </i>
                    @endif

                    <i class='fa fa-trash text-danger delCartItem cursor-pointer' title='Remove Item'></i>

                </div>

            

            </h5>

            {{-- <p>{{ $item->product->description }}</p> --}}
            <div class="price-box">
                <span>M.R.P <s class='text-danger'>₹ {{ $item->product->original_price }}</s></span>
                <span class='text-success ms-2'>₹ {{ $item->product->selling_price }}</span>
            </div>

        </div>
        

    </div>
    </a>
 
    <hr class='wrap'>

    @php 
    $total += $item->product->selling_price * $item->product_qty;
    $num =  $num++;
    @endphp

    @endforeach
    

</div>
</div>

<div class="col-md-4">
    <div class="card p-0">
        <div class="card-header">
            <h5>Total Amount</span></h5>
        </div>

@php 
$num= 1;
$product_total = 0;
@endphp

@foreach($cartItems as $index =>$item)
@php 
$product_total = $item->product->selling_price * $item->product_qty;
$num =  $num++;
@endphp

<div class="card-body pricing">
<p class='space-wrap'> 
    <i>{{ $item->product->name }}</i>
    <span>Item: {{ $num++ }}</span>
</p>
<p>
    <span>₹ {{ $item->product->selling_price }} * {{ $item->product_qty }}</span>
    <span>₹ {{ $product_total }}</span>
</p>
</div>

@endforeach
<hr class='m-0'>

<div class="card-body pricing">
<p> 
    <span><b>Grand Total</b></span>
    <span class='text-success'><b>₹ {{ $total }}</b></span>
</p>

<div class='checkout mt-3'>
<a href="{{ url('checkout') }}"><button class='btn btn-warning text-light'>Go To Checkout</button></a>
</div>

</div>
    
    </div>
</div>
@else

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
       <h5>Cart</h5>
        </div>
        <div class="card-body">

             <h6 class='text-danger text-center m-4'><i class="fa fa-shopping-cart"></i> 
                Your Cart is Empty!
            </h6>

            <h4 class='text-center m-4'>Order Now to enjoy our products!</h4>

            <div class='d-flex justify-content-center m-4'>
                <a href="{{ url('/category') }}" class='text-decoration-none'>
                <p class="explore-btn">Explore<i class="fa fa-arrow-right ms-2"></i></p>
                </a>
            </div>
            
        </div>
    </div>
</div>
    
@endif

</div>

</div>







@endsection