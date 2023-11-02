@extends('layouts.admin')
@section('title')Admin Profiles @endsection
@section('content')


<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class=''>Admin Profiles</h4>
                <div>
                    <a href="{{url('admin/create/user')}}" class='btn btn-sm btn-primary text-light'>Create User</a>
                    <a href="{{url('admin/users')}}" class='btn btn-sm btn-warning text-light'>View Users</a>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-responsive">
                    <thead>
                       <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php $num = 1 @endphp
                        @foreach ($users as $user) 
                            <tr>
                                <td>{{ $num++}} </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_as == '0'?'User':'Admin' }}</td>
                                <td>
                                    <div class="action-wrap">
                                        <a href="{{ url('admin/user/edit/'.$user->id) }}"><i class="mdi mdi-lead-pencil menu-icon mr-2 text-success"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#del-product-Modal" data-product-id="1" class="delete-product-btn">
                                        <i class="mdi mdi-delete menu-icon text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                


        
            </div>
        </div>


    </div>
</div>








@endsection