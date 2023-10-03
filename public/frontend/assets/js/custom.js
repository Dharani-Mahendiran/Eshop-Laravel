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


});

document.addEventListener('DOMContentLoaded', function () {
// Wishlist icon toggle
const commonlistIcons = document.querySelectorAll('.commonlist');
const wishlistIcons = document.querySelectorAll('.wishlist');

commonlistIcons.forEach((commonlistIcon, index) => {
  commonlistIcon.addEventListener('click', () => {
    commonlistIcon.style.display = 'none';
    wishlistIcons[index].style.display = 'inline-block';
  });
});

wishlistIcons.forEach((wishlistIcon, index) => {
  wishlistIcon.addEventListener('click', () => {
    wishlistIcon.style.display = 'none';
    commonlistIcons[index].style.display = 'inline-block';
  });
});


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
        window.location.reload();
      }
    });
  } else {
    
  }
});