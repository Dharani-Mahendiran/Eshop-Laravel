@extends('layouts.admin')
@section('title')Users @endsection
@section('content')




<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class=''>Registered Users</h4>
                <div>
                    <a href="{{url('admin/user/create')}}" class='btn btn-sm btn-primary text-light'>Create User</a>
                    <a href="{{url('admin/user/admin')}}" class='btn btn-sm btn-primary text-light'>Admin User</a>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-responsive">
                    <thead>
                       <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
                                <td>{{ $user->phone }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                


        
            </div>
        </div>


    </div>
</div>








@endsection