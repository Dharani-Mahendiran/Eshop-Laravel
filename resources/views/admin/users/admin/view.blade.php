@extends('layouts.admin')
@section('title')View Admin Profile @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex align-items-center justify-content-between mb-0">View Admin Profile
                        <a href="{{ url('admin/profiles') }}" class="btn btn-sm btn-danger text-light">Go Back</a>
                    </h4>
                </div>

                    <div class="card-body">
                        <form>
                        
                            <div class="row col-12">

                                <div class="col-md-6 mb-3">
                                <label for="name" class="">First Name</label>
                                <p class="form-control">{{ $user->name }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="lname" class="">Last Name</label>
                                <p class="form-control">{{ $user->lname }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="email" class="">Email</label>>
                                <p class="form-control">{{ $user->email }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="phone" class="">Phone</label>
                                <p class="form-control">{{ $user->phone }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="alt_contact" class="d">Alternative Contact</label>
                                <p class="form-control">{{ $user->alt_contact }}</p>
                                </div>

                                {{-- <div class="col-md-6 mb-3 form-group">
                                    <label for="password" class="">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control" type="password" value="{{ $user->password }}" id="password_field">
                                        <div class="input-group-addon">
                                            <button onclick="togglePassword()" type="button" class="btn btn-default" id="toggle_password_button"><i class="mdi mdi-eye-off" aria-hidden="true"></i></button>
                                        </div>
                                    </div> 
                                </div> --}}

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="">Role</label>
                                    <p class="form-control">{{ $user->role_as=='0'?'User':'Admin' }}</p>
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
