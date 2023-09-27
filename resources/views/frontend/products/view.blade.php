@extends('layouts.frontend')


@section('title'){{ $product->name }}@endsection
@section('body_class', 'home-index product-view')
@section('content')


<div class="section-bg">
<div class="container-fluid">
<div class="row ui">

    <div class="col-md-4">
        <i class='product-i'>
            <img src="{{ asset('uploads/product/'.$product->image)}}" alt={{ $product->name  }}>
        </i>
    </div>

    <div class="col-md-8 content">
        <div class='product-box'>
            <h4>{{ $product->name }}</h4>
            @if($product->trending == 1)
            <h6 class="">
                <span class='trending'>Trending</span>
                <i class='fa fa-heart' id='commonlist'></i>
                <i class='fa fa-heart text-danger' id='wishlist'></i>
            </h6>
            @endif
        </div>


        <div class="price-box">
            <span>M.R.P <s class='text-danger'>₹ {{ $product->original_price }}</s></span>
            <span class='text-success ms-2'>₹ {{ $product->selling_price }}</span>
        </div>

        <div class="feature-box">
            <h5> Description About this product:- </h5>
            <p>{{ $product->description }}</p>
        </div>


        
    
        <div class="cart">
            <div class="add-quantity">
                <button class="minus" aria-label="Decrease">&minus;</button>
                <input type="number" class="input-box" value="1" min="1" max="10">
                <button class="plus" aria-label="Increase">&plus;</button>
            </div>

        <form action="">
            <button class="btn buy-btn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Buy Now
            </button>

            <button class="btn cart-btn" tabindex="0">
                <i class="fa fa-shopping-cart"></i> Add To Cart
            </button>
        </form>
        </div>
    </div>
                       
</div>               
</div>
</div>

 <script>
// Wishlist icon toggle
    const commonlistIcon = document.getElementById('commonlist');
    const wishlistIcon = document.getElementById('wishlist');
    commonlistIcon.addEventListener('click', () => {
        commonlistIcon.style.display = 'none';
        wishlistIcon.style.display = 'inline-block';
    });

    wishlistIcon.addEventListener('click', () => {
        wishlistIcon.style.display = 'none';
        commonlistIcon.style.display = 'inline-block';
    });

// add quantity
(function () {
  const quantityContainer = document.querySelector(".add-quantity");
  const minusBtn = quantityContainer.querySelector(".minus");
  const plusBtn = quantityContainer.querySelector(".plus");
  const inputBox = quantityContainer.querySelector(".input-box");

  updateButtonStates();

  quantityContainer.addEventListener("click", handleButtonClick);
  inputBox.addEventListener("input", handleQuantityChange);

  function updateButtonStates() {
    const value = parseInt(inputBox.value);
    minusBtn.disabled = value <= 1;
    plusBtn.disabled = value >= parseInt(inputBox.max);
  }

  function handleButtonClick(event) {
    if (event.target.classList.contains("minus")) {
      decreaseValue();
    } else if (event.target.classList.contains("plus")) {
      increaseValue();
    }
  }

  function decreaseValue() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : Math.max(value - 1, 1);
    inputBox.value = value;
    updateButtonStates();
    handleQuantityChange();
  }

  function increaseValue() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
    inputBox.value = value;
    updateButtonStates();
    handleQuantityChange();
  }

  function handleQuantityChange() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : value;

    // Execute your code here based on the updated quantity value
    console.log("Quantity changed:", value);
  }
})();


</script>


@endsection