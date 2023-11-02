@extends('layouts.admin')
@section('title')Edit Admin Profile @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex align-items-center justify-content-between mb-0">Edit Admin Profile
                        <a href="{{ url('admin/profiles') }}" class="btn btn-sm btn-danger text-light">Go Back</a>
                    </h4>
                </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/user/'.$user->id) }}" class='UpdateUserForm'>
                        @csrf
                        @method('PUT')
                        
                            <div class="row col-12">

                                <div class="col-md-6 mb-3">
                                <label for="name" class="">Edit First Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                                <span id="name-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="lname" class="">Edit Last Name</label>
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ $user->lname }}">
                                <span id="lname-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="email" class="">Edit Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <span id="email-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="phone" class="">Edit Phone</label>
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ $user->phone }}">
                                <span id="contact-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="alt_contact" class="d">Edit Alternative Contact</label>
                                <input id="alt_contact" type="number" class="form-control" name="alt_contact" value="{{ $user->alt_contact }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="password" class="">Edit Password</label>
                                <input id="password" type="password" class="form-control" name="password" value='{{ $user->password }}'>
                                <span id="password-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="">Role </label>
                                    <input type="text" class="form-control" value='{{ $user->role_as=='0'?'User':'Admin' }}' disabled>
                                </div>

                    
                                <div class="col-12">
                                <button type='button' class="btn btn-primary text-light float-end update_user" onclick="update_user()">Create</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>




@endsection
