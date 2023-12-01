@extends('layouts.frontend')


@section('title') My Orders @endsection
@section('body_class', 'myorder')
@section('content')

<div class="container mt-5">


<div class="card">

<div class="card-header theme-bg">
    <h3>My Orders</h3>
</div>
@if(count($orders) > 0)
@foreach ($orders  as $order)
    @foreach ($orderItems[$order->id] as $item)


    <a href="{{ url('order-view/'.$item->id) }}" class='text-decoration-none cursor-pointer'>
        <div class="card-body row m-0 p-2">
            <div class='col-md-12' >
                {{-- <i>{{ $order->id }}</i> --}}
                <i class='card-img'>
                    <img class="card-img-top" src="{{ url('uploads/product/'.$item->product->image) }}" alt="Product image" width>
                </i>

            <div class='d-block'>
            <h4 class="">{{ $item->product->name }}</h4>

            @if ($item->status == '0')
            <div class="d-flex align-items-center">
                <h4 class='me-2'><i class='text-secondary'>Order Placed </i></h4>
                <h6 class='m-0'><i class='text-secondary'> on {{ $item->created_at }} </i></h6>
            </div>

            @elseif ($item->status == '1')
            <div class="d-flex align-items-center">
                <h4 class='me-2'><i class='text-secondary'>Item Dispatched</i></h4>
                @if($item->dispatched_date != null)
                <h6 class='m-0'><i class='text-secondary'> on {{ $item->dispatched_date }} </i></h6>
                @endif
            </div>

            @elseif ($item->status == '2')
            <div class="d-flex align-items-center">
                <h4 class='me-2'><i class='text-secondary'>In-Transit</i></h4>
                @if($item->intransit_date != null)
                <h6 class='m-0'><i class='text-secondary'> on {{ $item->intransit_date}} </i></h6>
                @endif
            </div>


            @elseif ($item->status == '3')

                <div class="d-flex align-items-center">
                    <h4 class='me-2' ><i class='text-success d-block'>Delivered</i></h4>
                    @if($item->delivered_date != null)
                    <h6 class='m-0'><i class='text-success'> on {{ $item->delivered_date }} </i></h6>
                    @endif
                </div>

                    <span class='rating-css'>
                        <i class='text-warning wrap'>Rate this Product ?</i>
                        <div class="rating-css d-none">
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
                    </span>

                @endif


                </div>

                    <i class="fa fa-arrow-right arrow" title="View Order"></i>

            </div>
        </div>
    </a>

        <hr class="wrap m-0">
    @endforeach
@endforeach



@else

        <div class="card-body d-block">

            <h6 class='text-danger text-center m-4'><i class="fa fa-shopping-cart"></i>
                No Orders Yet!
            </h6>

            <h4 class='text-center m-4'>Order Now to enjoy our products!</h4>

            <div class='d-flex justify-content-center m-4'>
                <a href="{{ url('/category') }}" class='text-decoration-none'>
                <p class="explore-btn">Explore<i class="fa fa-arrow-right ms-2"></i></p>
                </a>
            </div>

        </div>
@endif



</div>


</div>



@endsection
