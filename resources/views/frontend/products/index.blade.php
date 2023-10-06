@extends('layouts.frontend')


@section('title'){{ $category->name }}@endsection
@section('body_class', 'home-index category-products')
@section('content')

<div class="breadcrumb">
  <h4>Collection/{{ $category->name }}</h4>
</div>

<div class="py-5 bg-ui">
    <div class="container">

    <div class="row">
      @if(count($products)>0)
            @foreach($products as $product)
            <div class="col-md-3 mb-3">

              <a href="{{ url('category/'.$category->slug.'/'.$product->slug) }}" class='text-decoration-none'>
              <div class="card">
                <i class='card-img'><img class='' src="{{ asset('uploads/product/'.$product->image) }}" alt="Product Image"></i>
                
                <div class="card-body">
                  <h5>{{ $product->name }}</h5>
                  <span class='float-start text-success'>₹{{ $product->selling_price }}</span>
                  <span class='float-end text-danger'>M.R.P <s>₹{{ $product->original_price }}</span></s>
                </div>
              </div>
              </a>

            </div>
            @endforeach
        @else
            <div class="col-md-12 mt-4">
                <h4 class='text-danger text-center'>Oops! No Products Found!</h4>
            </div>

        @endif
        
  
    </div>
</div>
</div>



@endsection
