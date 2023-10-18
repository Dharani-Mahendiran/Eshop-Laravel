@extends('layouts.frontend')


@section('title') Checkout @endsection
@section('body_class', 'home-index mycart checkout')
@section('content')



<div class="breadcrumb">
    <h4>Home/Checkout</h4>
</div>

<div class="container">
<form action="{{ url('place-order')  }}" method='POST' class='FormCheckout'>
    {{ csrf_field() }}
    <div class="row">

        <div class="col-md-8">
            <div class="card p-0">
                <div class="card-header">
                    <h5>Basic Details</h5>
                </div>
                <div class="card-body row col-12 productData cursor-pointer">

                    
                        <div class="row form-wrap mb-3">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" class='form-control' placeholder="Enter First Name" name='name'>
                                <span id="name-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" class='form-control' placeholder="Enter Last Name" name='lname'>
                                <span id="lname-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class='form-control' placeholder="Enter Email" name='email'>
                                <span id="email-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone Number</label>
                                <input type="number" class='form-control' placeholder="Enter Phone Number" name='contact'>
                                <span id="contact-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Alternative Contact</label>
                                <input type="number" class='form-control' placeholder="Enter Alternative Contact" name='alt_contact'>
                                <span id="altcontact-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Address</label>
                                <input type="text" class='form-control' placeholder="Enter Address" name='address'>
                                <span id="address-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">City</label>
                                <input type="text" class='form-control' placeholder="Enter City" name='city'>
                                <span id="city-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">State</label>
                                <input type="text" class='form-control' placeholder="Enter State" name='state'>
                                <span id="state-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country</label>
                                <input type="text" class='form-control' placeholder="Enter Country" name='country'>
                                <span id="country-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Pincode</label>
                                <input type="number" class='form-control' placeholder="Enter Pincode" name='pincode'>
                                <span id="pincode-error" class='text-danger'></span>
                            </div>

                        </div>



                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-0">
            <div class="card-header">
            <h5>Order Details</span></h5>
            </div>
            @php 
            $num= 1;
            $product_total = 0;
            $grandTotal = 0;
            @endphp

            @foreach($cartItems as $index =>$item)
            @if($item->product->quantity > 0)
            @php 
            $num =  $num++;
            $product_total = $item->product->selling_price * $item->product_qty;
            $grandTotal += $product_total;
            @endphp

            <div class="card-body pricing">
                <p class='space-wrap'> 
                <span>Item: {{ $num++ }}</span>
                <i>{{ $item->product->name }}</i>
                </p>

                <table class='table text-center'>
                <thead> 
                <tr>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>₹ {{ $item->product->selling_price }}</td>
                <td>{{ $item->product_qty }}</td>
                <td>₹ {{ $product_total }}</td>
                </tr>
                </tbody>
                </table>
            </div>
            @endif   
            @endforeach


            <hr class='m-0'>

            <div class="card-body pricing">
            <p class='CartText-size'> 
                <span><b>Grand Total</b></span>
                <span class='text-success'><b>₹ {{ $grandTotal }}</b></span>
            </p>

            <div class='checkout mt-3'>
            <button type='button' class='btn btn-success text-light placeOrder' onclick='submitOrder()'>Place Order</button>
            </div>

            </div>
                
            </div>

        </div>

    </div>
</form>

</div>







@endsection