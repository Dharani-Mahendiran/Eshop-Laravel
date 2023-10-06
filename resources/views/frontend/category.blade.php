@extends('layouts.frontend')


@section('title') Category @endsection
@section('body_class', 'home-index category')
@section('content')

@include('layouts.inc.frontend_carousel')


<div class="py-5">
  <div class="container">
    <div class="row">
    <h2 class='text-center ui'>All Categories</h2>
    <div class="col-md-12">

    <div class="row">
      @foreach ($categories as $category)
      <div class="col-md-4 mb-3">

      <a href="{{ url('view-category/'. $category->slug) }}" class='text-decoration-none'>
        <div class="card">
          <i class='card-img'><img class='' src="{{ asset('uploads/category/'.$category->image) }}" alt="Category Image"></i>
          <div class="card-body">
            <h5>{{ $category->name }}</h5>
            <p>{{ $category->description }}</p>
          </div>
        </div>
      </a>

      </div>
      @endforeach
    </div>

    </div>
    </div>
  </div>
</div>


@endsection
