@extends('layouts.frontend')


@section('title') Welcome to Eshop @endsection
@section('body_class', 'home-index')
@section('content')

@include('layouts.inc.frontend_carousel')


<div class="py-5">
  <div class="container">

  <div class="row">
    <h2 class='text-center  ui'>Featured Products</h2>
      <div class="featured-carousel owl-carousel owl-theme mt-3">
          @foreach($featured_products as $product)
          <div class="item">
            <div class="card">
              <i class='card-img'><img class='' src="{{ asset('uploads/product/'.$product->image) }}" alt="Product Image"></i>
              
              <div class="card-body">
                <h5>{{ $product->name }}</h5>
                <span class='float-start text-success'>₹{{ $product->selling_price }}</span>
                <span class='float-end text-danger'>M.R.P <s>₹{{ $product->original_price }}</span></s>
              </div>
            </div>
          </div>
          @endforeach
    </div>

  </div>

  <div class="row mt-5">
    <h2 class='text-center ui'>Popular Categories</h2>
      <div class="featured-carousel owl-carousel owl-theme mt-3">
          @foreach($popular_categories as $category)
          <a href="{{ url('view-category/'. $category->slug) }}" class='text-decoration-none'>
          <div class="item">
            <div class="card">
              <i class='card-img'><img class='' src="{{ asset('uploads/category/'.$category->image) }}" alt="Category Image"></i>
              
              <div class="card-body">
                <h5>{{ $category->name }}</h5>
                <p>{{ $category->description }}</p>
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
  $('.featured-carousel').owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  dots:false,
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