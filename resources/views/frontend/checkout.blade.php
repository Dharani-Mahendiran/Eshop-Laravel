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
                                <input type="text" class='form-control' value="{{ Auth::user()->name ? Auth::user()->name : '' }}"  placeholder="Enter First Name" name='name'>
                                <span id="name-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->lname ? Auth::user()->lname : '' }}"   placeholder="Enter Last Name" name='lname'>
                                <span id="lname-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->email ? Auth::user()->email : '' }}"   placeholder="Enter Email" name='email'>
                                <span id="email-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone Number</label>
                                <input type="number" class='form-control' value="{{ Auth::user()->phone ? Auth::user()->phone : '' }}"  placeholder="Enter Phone Number"  name='contact'>
                                <span id="contact-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Alternative Contact</label>
                                <input type="number" class='form-control' value="{{ Auth::user()->alt_contact ? Auth::user()->alt_contact : '' }}"  placeholder="Enter Alternative Contact" name='alt_contact'>
                                <span id="altcontact-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Address</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->address ? Auth::user()->address : '' }}"   placeholder="Enter Address" name='address'>
                                <span id="address-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">City</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->city ? Auth::user()->city : '' }}"   placeholder="Enter City" name='city'>
                                <span id="city-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">State</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->state ? Auth::user()->state : '' }}"   placeholder="Enter State" name='state'>
                                <span id="state-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country</label>
                                <input type="text" class='form-control' value="{{ Auth::user()->country ? Auth::user()->country : '' }}"  placeholder="Enter Country" name='country'>
                                <span id="country-error" class='text-danger'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">Pincode</label>
                                <input type="number" class='form-control' value="{{ Auth::user()->pincode ? Auth::user()->pincode : '' }}"  placeholder="Enter Pincode" name='pincode'>
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

            <div class='checkout mt-3 d-block'>
                <input type="hidden" name='payment_mode' value='COD'>
                <button type='button' class='btn btn-success text-light placeOrder w-100 mb-3' onclick='submitOrder()'>Place Order | COD</button>
                <button type='button' class='btn btn-danger text-light razerpay_btn w-100  mb-3' onclick='razorpay()'>Pay with Razorpay</button>
                <div class='btn btn-warning text-light paypal_btn w-100' id="paypal-button-container">Paypal</div>
            </div>

            </div>
                
            </div>

        </div>

    </div>
</form>

</div>

@endsection

@section('scripts')
{{-- paypal --}}
<script src="https://www.paypal.com/sdk/js?client-id=AYeAijT-YQbNmDHdT3d4qmpkEuG62vDKGR-50jxL89YH-09Rqs_Ip8uRVJaLlFVCChr5-1tECe0YWKj4"> 

// Replace YOUR_CLIENT_ID with your sandbox client ID</script>
{{-- RazorPay --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

{{-- paypal script --}}
<script>

$(document).ready(function () {

    $('.paypal_btn').click(function (e) { 
        e.preventDefault();
        
        // Remove existing error messages
        $(".text-danger").text("");
        
        // Track whether there are validation errors
        let hasError = false;

            const name = $("input[name='name']").val();
            if (name === "") {
                $("#name-error").text("First Name is required");
                hasError = true;
            } else if (!/^[a-zA-Z]+$/.test(name)) {
                $("#name-error").text("Only letters allowed");
                hasError = true;
            }

            const lname = $("input[name='lname']").val();
            if (lname === "") {
            $("#lname-error").text("Last Name is required");
                hasError = true;
            }else if (!/^[a-zA-Z]+$/.test(lname)) {
            $("#lname-error").text("Only letters alowed");
            hasError = true;
            }

            function isValidEmail(email) {
            const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            return emailRegex.test(email);
            }

            const email = $("input[name='email']").val();
            if (email === "") {
            $("#email-error").text("Email is required");
                hasError = true;
            }else if (!isValidEmail(email)) {
            $("#email-error").text("Enter a valid email address");
            hasError = true;
            }

            function isValidPhoneNumber(phoneNumber) {
            const phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phoneNumber);
            }
            const contact = $("input[name='contact']").val();
            if (contact === "") {
            $("#contact-error").text("contact is required");
                hasError = true;
            }else if (!isValidPhoneNumber(contact)) {
            $("#contact-error").text("Enter valid phone number");
                hasError = true;
            }

            const alt_contact = $("input[name='alt_contact']").val();
            // if (alt_contact === "") {
            //   $("#altcontact-error").text("Alternative Contact is required");
            //     hasError = true;
            // }
            if (alt_contact !== "" && !isValidPhoneNumber(alt_contact)) {
            $("#altcontact-error").text("Enter valid contact");
            hasError = true;
            }

            const address = $("input[name='address']").val();
            if (address === "") {
            $("#address-error").text("Address is required");
                hasError = true;
            }else if (address.length > 100){
            $("#address-error").text("Maximum 100 characters allowed");
            hasError = true;
            }

            const city = $("input[name='city']").val();
            if (city === "") {
            $("#city-error").text("City is required");
                hasError = true;
            }else if (city.length > 30){
            $("#city-error").text("Maximum 30 characters allowed");
            hasError = true;
            }

            const state = $("input[name='state']").val();
            if (state === "") {
            $("#state-error").text("State is required");
                hasError = true;
            }else if (state.length > 30){
            $("#state-error").text("Maximum 30 characters allowed");
            hasError = true;
            }
            
            const country = $("input[name='country']").val();
            if (country === "") {
            $("#country-error").text("Country is required");
                hasError = true;
            }else if (country.length > 30){
            $("#country-error").text("Maximum 30 characters allowed");
            hasError = true;
            }

            const pincode = $("input[name='pincode']").val();
            if (pincode === "") {
            $("#pincode-error").text("Pincode is required");
                hasError = true;
            }



        if (hasError) {
            return;
        } else {

            // alert(name); 

            paypal.Buttons({
            // Order is created on the server and the order id is returned
                createOrder: function (data, actions) {
                    return actions.order.create({
                    purchase_units: [{ amount : {value: '{{ $product_total }}' } }]
                    }) 
                },

                onApprove: function (data, actions) {
                    return actions.order.capture().then(function(details){
                    // alert('Transaction completed by' + details.payer.name.given_name);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var name = $("input[name='name']").val();
                var lname = $("input[name='lname']").val();
                var email = $("input[name='email']").val();
                var contact = $("input[name='contact']").val();
                var alt_contact = $("input[name='alt_contact']").val();
                var address = $("input[name='address']").val();
                var city = $("input[name='city']").val();
                var state = $("input[name='state']").val();
                var country = $("input[name='country']").val();
                var pincode = $("input[name='pincode']").val();
                 
                
                // alert(name);


                $.ajax({
                    type: "POST",
                    url: "/proceed-to-pay",
                    data: {
                        'name': name,
                        'lname': lname,
                        'email': email,
                        'contact': contact,
                        'alt_contact': alt_contact,
                        'address': address,
                        'city': city,
                        'state': state,
                        'country': country,
                        'pincode': pincode,
                        'payment_mode' : 'Paid by Paypal',
                        'payment_id' : details.id,
                    },
                  
                    success: function (response) {
                    // alert(response.message);
                    swal({
                    title: "Payment Successful!",
                    text: response.message,
                    icon: "success",
                    }).then(function() {
                        setTimeout(function() {
                            window.location.href = '/my-orders';
                        }, 1000);
                    });
                    }
                });



                    }) 
                },
            }).render('#paypal-button-container');

            
        }


   
});

});


</script>

@endsection

