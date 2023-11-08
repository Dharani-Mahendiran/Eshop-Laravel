$(document).ready(function () {

    $('.razerpay_btn').click(function (e) { 
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //  alert(name);
            var data = {
                'name': name,
                'lname': lname,
                'email': email,
                'contact': contact,
                'alt_contact': alt_contact,
                'address': address,
                'city': city,
                'state': state,
                'country': country,
                'pincode': pincode
            };


            $.ajax({
                type: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function (response) {
                //   alert(response.name);

                var options = {
                    "key": "rzp_test_9J5ZaBNiFOACMT", // Enter the Key ID generated from the Dashboard
                    "amount": response.total_price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.name+' '+response.lname, //your business name
                    "description": "Thank you for choosing us",
                    "image": "https://example.com/your_logo",
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                   
                    "handler":function(response_a){
                        // alert(response_a.razorpay_payment_id);

                        // store order after successful payment
                        $.ajax({
                            type: "POST",
                            url: "/place-order",
                            data: {
                                'name': response.name,
                                'lname': response.lname,
                                'email': response.email,
                                'contact': response.contact,
                                'alt_contact': response.alt_contact,
                                'address': response.address,
                                'city': response.city,
                                'state': response.state,
                                'country': response.country,
                                'pincode': response.pincode,
                                'payment_mode': 'Paid By Razorpay',
                                'payment_id' :response_a.razorpay_payment_id,
                            },
                            success: function (response_b) {
                                // alert(response_b.message);
                                swal({
                                    title: "Payment Successful!",
                                    text: response_b.message,
                                    icon: "success",
                                }).then(function() {
                                    setTimeout(function() {
                                        window.location.href = '/my-orders';
                                    }, 1000);
                                });
                            }
                            
                            
                        });

                    },
                   
                    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                        "name": response.name+' '+response.lname, //your customer's name
                        "email": response.email,
                        "contact": response.contact //Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
             

                }
            });

            
        }
   
    });
});
