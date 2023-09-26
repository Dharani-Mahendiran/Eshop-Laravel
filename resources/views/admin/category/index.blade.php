@extends('layouts.admin')

@section('content')


<!-- Delete Category Modal -->
<div class="modal fade" id="del-category-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-danger">Delete Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
        </div>
        <div class="modal-body">
         <h5>Are you sure, you want to delete this category?</h5>
         {{-- <p id="show-cate-id"></p> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="" id="delete-link" class="btn btn-danger text-light">Yes, Delete</a>
        </div>
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-12">

        {{-- Commented this coz, we use 'SWEET ALERT IN HERE' layouts\admin.blade.php  --}}
         {{-- alert message --}}
         {{-- @if(session('message'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{(session('message'))}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
         @endif --}}  


        <div class="card">
            <div class="card-header">
                <h4 class='d-flex align-items-center justify-content-between'>Category List
                    <a href="{{url('admin/category/create')}}" class='btn btn-sm btn-primary text-light'>Add Category</a>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-striped table-responsive">
                    <thead>
                       <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>status</th>
                        <th>Popular</th>
                        <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>


                        @foreach ($categories as $category)
                        <tr>
                            {{-- you can write in either way $category->id OR $category['id']--}}
                            <td>{{$category['id']}}</td>
                            <td>{{$category['name']}}</td>
                            <td><img src="{{ asset('uploads/category/' . $category['image']) }}" alt="Category Image"></td>
                            <td>{{$category['status']=='1'?'Hidden':'Visible'}}</td>
                            <td>{{$category['popular']=='1'?'Popular':'Unpopular'}}</td>
                            <td>

                                <div class="action-wrap">
                                    <a href="{{ url('admin/category/edit/'.$category->id) }}"><i class="mdi mdi-lead-pencil menu-icon mr-2 text-success"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#del-category-Modal" 
                                        data-category-id="{{ $category->id }}" 
                                        class="delete-category-btn">
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



<script>
    // Update modal content when the delete button is clicked
    document.querySelectorAll('.delete-category-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var categoryId = this.getAttribute('data-category-id');
            document.getElementById('show-cate-id').textContent = 'Category ID: ' + categoryId;
            var deleteLink = document.getElementById('delete-link');
            deleteLink.href = "{{ url('admin/category/del-category') }}/" + categoryId; // Update the delete link URL
            $('#delete-link').attr('href', deleteUrl);
        });
    });
</script>

@endsection