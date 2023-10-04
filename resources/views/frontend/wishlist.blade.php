@extends('layouts.frontend')


@section('title') My Wish List @endsection
@section('body_class', 'wishList')
@section('content')


<div class="breadcrumb">
    <h4>Home/Wish List</h4>
</div>

<div class="container">
    

<div class="row">

@if(count($wishListItems) > 0)

<div class="col-md-12">
<div class="card p-0">
    <div class="card-header">
        <h5>Wishlisted Items<span> ({{ count($wishListItems) }})</span></h5>
    </div>

    @foreach($wishListItems as $item)

    <input type="hidden" value='{{ $item->id }}' class='cart_id'>

    <div class="card-body row productData">

            <div class='cart-body'>

            <div class="row col-12">

            <div class='col-md-2 cart-img'>
                <i><img src="{{ asset('uploads/product/'.$item->product->image)}}" alt={{ $item->product->name  }}></i>
            </div>

            <div class="col-md-8 itemData">
                <h5 class='wrap me-3'>{{ $item->product->name }}s</h5>

                <div class="price-box me-3">
                    <span>M.R.P <s class="text-danger">₹ {{ $item->product->selling_price }}</s></span>
                    <span class="text-success ms-2">₹ {{ $item->product->original_price }}</span>
                </div>
            </div>


            <div class="col-md-2 actn-btns">
                <a href="{{ url('category/'.$item->product->category->slug.'/'.$item->product->slug) }}" class='me-3'>
                    <i class='fa fa-eye cursor-pointer' title='View Product'>
                        <span>View</span>
                    </i>
                </a>
                <i class='fa fa-heart text-danger cursor-pointer wishlist' title='Remove from wish list'>
                    <span>Remove</span>
                </i>
            </div>

            </div>


            </div>
     
    
    </div>

    <hr class='wrap'>

    @endforeach
    

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
               No Items Found!
            </h6>

            <h4 class='text-center m-4'>Wish List Your Products here!</h4>

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