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

    @foreach($cartItems as $index =>$item)

    <input type="hidden" value='{{ $item->id }}' class='cart_id'>

    <a href="{{ url('category/'.$products[$index]->category->slug.'/'.$products[$index]->slug) }}" class="text-decoration-none color-inherit">
    
    <div class="card-body row col-12 productData  cursor-pointer">
        <div class='cart-img col-md-4'>
            <i>
            <img src="{{ asset('uploads/product/'.$item->product->image)}}" alt={{ $item->product->name  }}>
            </i>
        </div>

    
        <div  class='cart-body col-md-8'>
            <h5 class='wrap'>{{ $item->product->name }}
                <input type="hidden" value='{{ $item->product_id }}' class='product_id'>
                <div class="add-quantity">
                    <button class="minus" aria-label="Decrease">&minus;</button>
                    <input type="number" name='quantity' class="qty-input" value='{{ $item->product_qty }}'>
                    <button class="plus" aria-label="Increase">&plus;</button>

                    @if($wishlist->where('user_id', Auth::id())->where('product_id', $item->product->id)->count() > 0)
                    <i class='fa fa-heart text-danger wishlist cursor-pointer border-0' data-wishlist-state="1" title='Remove from wish list'>
                    </i>
                    @else
                        <i class='fa fa-heart text-grey commonlist cursor-pointer border-0' data-wishlist-state="0" title='Add to Wish list'>
                        </i>
                    @endif

                </div>

            

            </h5>

            <p>{{ $item->product->description }}</p>


            <i class='fa fa-trash text-danger me-2 delCartItem cursor-pointer' title='Remove Item'>
                <span>Remove Item</span>
            </i>
    


        </div>
        

    </div>
    </a>
 
    <hr class='wrap'>

    @endforeach
    

</div>
</div>

<div class="col-md-4">
    <div class="card p-0">
        <div class="card-header">
            <h5>Total Amount</span></h5>
        </div>
        <div class="card-body pricing">
            <p>
                <span>M.R.P</span>
                <span><s class='text-danger'>₹ 2000</s></span>
            </p>


            <p>
                <span>Discount</span>
                <span>₹ 1000</span>
            </p>
           
                
            <p> 
                <span>Total</span>
                <span>₹ 1000</span>
            </p>

            <hr>

            <p> 
                <span><b>Grand Total</b></span>
                <span class='text-success'><b>₹ 1000</b></span>
            </p>

            <div class='checkout'>
            <button class='btn btn-warning text-light'>Go To Checkout</button>
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