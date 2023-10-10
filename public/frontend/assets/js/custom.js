// add and decrease quantity
$(document).ready(function () {

// add to cart ajax jquery
$('.addToCartBtn').click(function (e) { 
  e.preventDefault();
  
  var product_id = $(this).closest('.productData').find('.product_id').val();
  var product_qty =  $(this).closest('.productData').find('.qty-input').val();

  // console.log('productId=' + product_id + ' productQty=' + product_qty);


  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  // on clicking on addToCart, add details to the cart table
  $.ajax({
    method: "POST",
    url: "/add-to-cart",
    data:{
      'product_id' : product_id,
      'product_qty' : product_qty,
    },
    success: function (response) {
      swal(response.status);
    }
  });

});

  $('.plus').click(function (e) { 
    e.preventDefault();

    var inc_val = $(this).closest('.productData').find('.qty-input').val();
    var value = parseInt(inc_val, 10);

    // Use isNaN to check if it's Not A Number
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
      value++;
      $(this).closest('.productData').find('.qty-input').val(value);
    }
  });



  $('.minus').click(function (e) { 
    e.preventDefault();

    var dec_val = $(this).closest('.productData').find('.qty-input').val();
    var value = parseInt(dec_val, 10);

    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      $(this).closest('.productData').find('.qty-input').val(value);
    }
  });

    // if the user type more than 10, enforce the inpiut val to max 10
    $('.qty-input').on('input', function () {
    var value = parseInt($(this).val(), 10);

    if (isNaN(value) || value < 1) {
      $(this).val(1);
    } else if (value > 10) {
      $(this).val(10);
    }
  });

// Cart section total count

$('.changeQuantity').click(function (e) { 
  e.preventDefault();
  var product_id = $(this).closest('.productData').find('.product_id').val();
  var product_qty =  $(this).closest('.productData').find('.qty-input').val();

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$.ajax({
  method : "POST",
  url: "update-cart",
  data: {
    'product_id' : product_id,
    'product_qty' : product_qty,
  },
  success: function (response) {
    //  alert(response.status);
    window.location.reload();
  }
});


});


});

document.addEventListener('DOMContentLoaded', function () {

// Notify icon toggle
const notifyIcons = document.querySelectorAll(".notify-bell");
const notifiedIcons = document.querySelectorAll(".notified");

notifyIcons.forEach((notifyIcon, index) => {
  notifyIcon.addEventListener("click", function() {
    notifyIcon.style.display = "none";
    notifiedIcons[index].style.display = "inline-block";
  });
});

notifiedIcons.forEach((notifiedIcon, index) => {
  notifiedIcon.addEventListener("click", function() {
    notifyIcons[index].style.display = "inline-block"; 
    notifiedIcon.style.display = "none";
  });
});



});



// Delete Cart Items
$('.delCartItem').click(function (e) { 
  e.preventDefault();

  $product_id =  $(this).closest('.productData').find('.product_id').val();
  // alert($product_id);

  var confirmDelete = confirm('Remove item from cart?');
  if (confirmDelete) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      type: "POST",
      url: "delete-cartItem",
      data: {
        'product_id' : $product_id,
      },
      success: function (response) {
        swal("", response.status, "success");
        setTimeout(function() {window.location.reload();}, 1000);
      }
    });
  } else {
    
  }
});


// Handle the click event to toggle the wishlist state and update the icon
$('.commonlist, .wishlist').click(function(e) {
  e.preventDefault();

  var product_id = $(this).closest('.productData').find('.product_id').val();

  var icon = $(this); // Store a reference to the clicked icon

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  // Toggle the data-wishlist-state attribute
  var wishlistState = icon.data('wishlist-state');
  var newWishlistState = 1 - wishlistState; // Toggle between 0 and 1

  // Send AJAX request to update the database with the new wishlist state
  $.ajax({
      method: "POST",
      url: newWishlistState === 1 ? "/add-to-wishlist" : "/delete-wishlist",
      data: {
          'product_id': product_id,
          'wishlist_state': newWishlistState,
      },
      success: function(response) {
          swal(response.status);

          // Update the data-wishlist-state attribute and toggle the icon display
          icon.data('wishlist-state', newWishlistState);

          if (newWishlistState === 1) {
              icon.addClass('text-danger');
              icon.removeClass('text-grey');
          } else {
              icon.removeClass('text-danger');
              icon.addClass('text-grey');
          }
      }
  });
});

$('.wishlistBtn').click(function(e) {
  e.preventDefault();

  var product_id = $(this).closest('.productData').find('.product_id').val();
  var confirmDelete = confirm('Remove from wish list?');
  if (confirmDelete) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $.ajax({
      method: "POST",
      url: "/delete-wishlist",
      data: {
          'product_id': product_id,
      },
  success: function (response) {
        swal("", response.status, "success");
        setTimeout(function() {window.location.reload();}, 1000);
      }
    });
  } else {
    
  }
});


// form validation for checkout basic details
document.querySelector('.placeOrder').addEventListener('click', function (event) {
event.preventDefault();

// Remove all existing error messages
$(".text-danger").text("");

// Track whether there are validation errors
let hasError = false;

$(".FormCheckout").each(function () {

const name = $("input[name='name']").val();
  if (name === "") {
    $("#name-error").text("First Name is required");
    hasError = true;
  }else if (!/^[a-zA-Z]+$/.test(name)) {
    $("#name-error").text("Only letters alowed");
    hasError = true;
  }

const lname = $("input[name='l_name']").val();
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
}


});

});