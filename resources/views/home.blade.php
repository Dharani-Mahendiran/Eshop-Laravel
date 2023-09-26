@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    {{-- successful login --}}
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    {{-- warning if any --}}
                    @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('warning') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                  
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
