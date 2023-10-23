@extends('layouts.frontend')


@section('title') My Orders @endsection
@section('body_class', 'myorder')
@section('content')

<div class="container mt-5">


<div class="card">
  
<div class="card-header theme-bg">
    <h3>My Orders</h3>
</div>

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
                <i class='text-danger'>Delivery by </i>
                @else

                    <i class='text-success d-block'>Delivered</i>
                    <span class='ratings'>
                        <i class='text-warning wrap'>Rate Product</i>
                        <ul>
                            <li><i class='fa fa-star'></i></li>
                            <li><i class='fa fa-star'></i></li>
                            <li><i class='fa fa-star'></i></li>
                            <li><i class='fa fa-star'></i></li>
                            <li><i class='fa fa-star'></i></li>
                        </ul>
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


</div>


</div>



@endsection