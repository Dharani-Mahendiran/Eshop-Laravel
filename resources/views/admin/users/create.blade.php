@extends('layouts.admin')
@section('title')Create User @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex align-items-center justify-content-between mb-0">Create User
                        <a href="{{ url('admin/users') }}" class="btn btn-sm btn-danger text-light">Go Back</a>
                    </h4>
                </div>
   

                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/users') }}" class='CreateUserForm'>
                        @csrf
                            <div class="row col-12">

                                <div class="col-md-6 mb-3">
                                <label for="name" class="">First Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <span id="name-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="lname" class="">Last Name</label>
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}">
                                <span id="lname-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="email" class="">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <span id="email-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="phone" class="">Phone</label>
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}">
                                <span id="contact-error" class='text-danger'></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="alt_contact" class="d">Alternative Contact</label>
                                <input id="alt_contact" type="number" class="form-control" name="alt_contact" value="{{ old('alt_contact') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                <label for="password" class="">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                <span id="password-error" class='text-danger'></span>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="role" class="">Role</label>
                                    <select id="role" class='form-select' name='role_as'>
                                        <option value="">Select Role</option>
                                        <option value="0" >User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <span id="role-error" class='text-danger'></span>
                                </div>

                                <div class="col-12">
                                <button type='button' class="btn btn-primary text-light float-end save_user" onclick="save_user()">Create</button>
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
