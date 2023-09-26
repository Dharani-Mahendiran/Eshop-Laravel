@extends('layouts.app')
@section('title', 'Two Step Verification')
@section('body_class', 'two-factor')
@section('content')
<div class="row justify-content-center m-4">
    <img src="{{ asset('image/logo-pro-secure-labs.svg') }}" width="200" />
    <div class="col-md-12">
        <div class="card-group">
       
            <div class="card p-4">
                <div class="card-body">
                    {{-- @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif --}}
                    <form method="POST" action="{{ route('verify.store') }}">
                        {{ csrf_field() }}
                        <h1>Two Factor Verification</h1>
                        <p class="text-muted">
                            If you did not receive the code, click here to <a href="{{ route('verify.resend') }}">Resend.</a>
                        </p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input name="two_factor_code" type="text" class="m-0 form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required autofocus placeholder="Two Factor Code">
                            @if($errors->has('two_factor_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('two_factor_code') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 footer">
                                <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    Logout
                                </button>
                           
                                <button type="submit" class="btn btn-primary px-4">
                                    Verify
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection