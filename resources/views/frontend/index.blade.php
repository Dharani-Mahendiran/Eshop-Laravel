@extends('layouts.frontend')


@section('title') Welcome to Eshop @endsection
@section('body_class', 'home-index')
@section('content')

@include('layouts.inc.frontend_carousel')


<div class="py-5 bg-ui">
  <div class="container">

  <div class="row">
    <h2 class='text-center  ui'>Featured Products</h2>
      <div class="featured-products owl-carousel owl-theme mt-3">
          @foreach($featured_products as $product)
          <div class="item">
            <a href="{{ url('category/'.$product->category->slug.'/'.$product->slug) }}" class='text-decoration-none'>
            <div class="card">
              <i class='card-img'><img class='' src="{{ asset('uploads/product/'.$product->image) }}" alt="Product Image"></i>
              <div class="card-body">
                <h5 class='text-ui'>{{ $product->name }}</h5>
                <span class='float-start text-success'>₹{{ $product->selling_price }}</span>
                <span class='float-end text-danger'>M.R.P <s>₹{{ $product->original_price }}</span></s>
              </div>
            </div>
            </a>
          </div>
          @endforeach
    </div>

  </div>

  <div class="row mt-5">
    <h2 class='text-center ui'>Popular Categories</h2>
      <div class="popular-categories owl-carousel owl-theme mt-3">
          @foreach($popular_categories as $category)
          <a href="{{ url('view-category/'. $category->slug) }}" class='text-decoration-none'>
          <div class="item">

            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class='card-img'><img class='' src="{{ asset('uploads/category/'.$category->image) }}" alt="Category Image"></i>
                  <h4>{{ $category->name }}</h4>
                  <p class='p-btn'>Explore<i class="fa fa-arrow-right ms-2"></i></p>
                </div>
                <div class="flip-card-back">
                  <p>{{ $category->description }}</p>
                </div>
              </div>
            </div>

          </div>
          </a>
          @endforeach
    </div>





  </div>



  </div>
</div>


@endsection


@section('scripts')
<script>
  $('.featured-products').owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  dots:false,
  autoplay: true,
  autoplayTimeout: 3000,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
});



$('.popular-categories').owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  dots:true,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
});

</script>
@endsection