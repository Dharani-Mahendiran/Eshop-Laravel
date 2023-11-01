@extends('layouts.admin')
@section('title') Add Category @endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class='d-flex align-items-center justify-content-between'>Add Category
                    <a href="{{url('admin/category')}}" class='btn btn-sm btn-danger text-light'>Go Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form action="{{url('admin/category')}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name='name'>
                        @error('name')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name='slug'>
                        @error('slug')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea class="form-control" name='description' id=""  rows="3"></textarea>
                        @error('description')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Image</label><br/>
                        <input type="file" class="form-control" name="image" id="imageInput">
                        @error('image')<small class='text-danger'>{{$message}}</small>  @enderror
                        <small id="errorText" class='text-danger'></small>
                        <div class="image-container">
                            <img id="selectedImage" src="" alt="">
                            <!-- Close button to remove the selected image -->
                            <button class="close-button" onclick="removeSelectedImage()">&times;</button>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name='status' onchange="toggleStatus()">
                        <span id="statusSpan" class="text-success">Visible</span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" name='popular' onchange="togglePopular()">
                        <span id="popularSpan" class="text-danger">Unpopular</span>
                    </div>


                    <h4 class='bg-light p-2 text-dark mb-3'>SEO TAGS</h4>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" class="form-control" name='meta_title'>
                        @error('meta_title')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keyword</label>
                        <textarea class="form-control" name='meta_keyword' id=""  rows="3"></textarea>
                        @error('meta_keyword')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea class="form-control" name='meta_description' id=""  rows="3"></textarea>
                        @error('meta_description')<small class='text-danger'>{{$message}}</small>  @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type='submit' class='btn btn-small btn-primary float-end text-white'>Save</button>
                    </div>

                </div>
                </form>

            </div>
        </div>


    </div>
</div>

{{-- Image to be shown will selection after validation --}}
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        event.preventDefault(); // Prevent the form submission
        const fileInput = event.target;
        const selectedFile = fileInput.files[0];
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];
        const imageContainer = document.querySelector('.image-container');

        if (selectedFile) {
            const fileExtension = selectedFile.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                document.getElementById('errorText').textContent = "Error: Unsupported file format. Allowed formats are jpg, jpeg, png, and svg.";
                document.getElementById('selectedImage').src = '';
                fileInput.value = ''; // Clear the file input value to allow re-selection
                document.querySelector('.close-button').style.display = 'none'; // Hide the close button
                imageContainer.style.display = 'none'; // Hide the image container
            } else {
                document.getElementById('errorText').textContent = '';
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('selectedImage').src = e.target.result;
                    document.querySelector('.close-button').style.display = 'block'; // Show the close button
                    imageContainer.style.display = 'inline-block'; // Show the image container
                };

                reader.readAsDataURL(selectedFile);
            }
        } else {
            document.getElementById('errorText').textContent = '';
            document.getElementById('selectedImage').src = '';
            document.querySelector('.close-button').style.display = 'none'; // Hide the close button
            imageContainer.style.display = 'none'; // Hide the image container
        }
    });

    document.querySelector('.close-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the form submission when the close button is clicked
        document.getElementById('imageInput').value = ''; // Clear the file input value
        document.getElementById('selectedImage').src = ''; // Clear the image
        document.querySelector('.close-button').style.display = 'none'; // Hide the close button
        document.querySelector('.image-container').style.display = 'none'; // Hide the image container
    });
</script>




@endsection