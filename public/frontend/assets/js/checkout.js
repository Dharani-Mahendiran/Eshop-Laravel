$(document).ready(function () {
    $('.razerpay_btn').click(function (e) { 
        e.preventDefault();
        
        // Remove existing error messages
        $(".text-danger").text("");
        
        // Track whether there are validation errors
        let hasError = false;

        // Declaring variables outside the each loop
        let name, lname, email, contact, alt_contact, address, city, state, country, pincode;

        $(".placeOrder").each(function () {
            name = $(this).find("input[name='name']").val();
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

        });

       
        if (hasError) {
            return;
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                    // Handle the success response here
                }
            });

            $(".FormCheckout").submit();
        }
    });
});
