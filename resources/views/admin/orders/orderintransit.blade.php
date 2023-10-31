@extends('layouts.admin')
@section('title') In-TransitOrders @endsection
@section('content')



<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header d-md-flex align-items-center justify-content-between d-block">
                <h4 class='m-0'>Order In-Transit</h4>
                <div class='my-2 my-md-0'>
                    <a href="{{url('admin/orders')}}" class='btn btn-sm btn-success text-light'>New Orders</a>
                    <a href="{{url('admin/order-packed')}}" class='btn btn-sm bg-info text-light mr-2'>Dispatched</a>
                    {{-- <a href="{{url('admin/order-intransit')}}" class='btn btn-sm bg-warning  text-light mr-2'>In transit</a> --}}
                    <a href="{{url('admin/order-delivered')}}" class='btn btn-sm bg-danger text-light'>Delivered</a>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-responsive">
                    <thead>
                       <tr>
                        <th>ID</th>
                        <th>Order Date</th>
                        <th>Tracking Number</th>
                        <th>Image</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                       </tr>
                    </thead>  
                        @php  
                            $num= 1 
                        @endphp
                    <tbody>
                      

                        @foreach ($orderItem as $item) 
                            <tr>
                            <td>{{ $num++ }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->tracking_number }}</td>
                            <td><img src="{{ url('uploads/product/'.$item->product->image) }}" alt="product image"> </td>
                            <td>{{ $item->price}}</td>
                            <td>
                                @if($item->status=='0')
                                    Order Placed
                                @elseif($item->status=='1')
                                    Item Dispatched
                                @elseif($item->status=='2')
                                    In Transit
                                @elseif($item->status=='3')
                                    Delivered
                                @endif
                            </td>
                            
                            <td>
                                <div class="action-wrap">
                                    <a href="{{ url('admin/order-view/'.$item->id) }}" target='blank'><i class="mdi mdi-eye menu-icon"></i></a>
                                </div>
                            </td>
                            </tr>
                        
                        @endforeach
                       
                    </tbody>
                </table>
                


        
            </div>
        </div>


    </div>
</div>







@endsection