@extends('layouts.admin')

@section('content')

<!-- Delete Category Modal -->
<div class="modal fade" id="del-product-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-danger">Delete Product</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Are you sure, you want to delete this category?</h5>
            {{-- <p id="show-product-id"></p> --}}
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

        <div class="card">
            <div class="card-header">
                <h4 class='d-flex align-items-center justify-content-between'>Category List
                    <a href="{{url('admin/product/create')}}" class='btn btn-sm btn-primary text-light'>Add Products</a>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-striped table-responsive">
                    <thead>
                       <tr>
                        <th>P_ID</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>status</th>
                        <th>Trending</th>
                        <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product) 
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product['name']}}</td>
                                <td><img src="{{ asset('uploads/product/' . $product['image']) }}" alt="Product Image"></td>
                                <td class='text-danger'>{{$product['original_price']}}</td>
                                <td class='text-success'>{{$product['selling_price']}}</td>
                                <td>{{$product['status']=='1' ? 'Hidden' : 'Visible'}}</td>
                                <td>{{$product['trending']=='1' ? 'trending' : 'Common'}}</td>
                                <td>
                                    <div class="action-wrap">
                                        <a href="{{ url('admin/product/edit/'.$product->id) }}"><i class="mdi mdi-lead-pencil menu-icon mr-2 text-success"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#del-product-Modal" 
                                        data-product-id="{{ $product->id }}" 
                                        class="delete-product-btn">
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
    document.querySelectorAll('.delete-product-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            document.getElementById('show-product-id').textContent = 'Product ID: ' + productId;
            var deleteLink = document.getElementById('delete-link');
            deleteLink.href = "{{ url('admin/category/del-category') }}/" + productId; // Update the delete link URL
            $('#delete-link').attr('href', deleteUrl);
        });
    });
</script>




@endsection