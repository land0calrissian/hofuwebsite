@include('header')

@extends('layouts.app')

@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Create Item Form</h1>
           
        </div>
<div class="container">
    <p class = "text-lg-start fs-3 text-black mt-3 mb-3 fw-bold">Insert Your Item Details</p>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- @section('content') --}}

    
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-5">
            <div class="col-md-12 col-lg-6 col-xl-7">
            <div class="row text-black fw-bold">
                
            
                 <!-- Item Name -->
                <div class="form-group">
                    <label for="name">Item Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder = "ex. Americano" required>
                </div>

                <!-- Description -->
                <div class="form-group mt-3">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="2" placeholder = "ex. 1 shot of coffee added with milk and palm sugar" required></textarea>
                </div>

                <!-- Price -->
                <div class="form-group mt-3">
                    <label for="price">Price(Rupiah):</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder = "Rp" required>
                </div>

                <!-- Category Dropdown -->
                <div class="form-group mt-3">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="1">Coffee</option>
                        <option value="2">Non Coffee</option>
                        <option value="3">Snack</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="form-group mt-3 mb-5">
                    <label for="image">Item Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image" required required onchange="previewImage(event)">
                </div>

                <button type="submit" class="btn btn-primary mb-5">Create Item</button>
    </form>
             </div>
        </div>
            <div class="col-md-12 col-lg-6 col-xl-5">
                <div class="form-group mt-3 mb-5 text-center">
                    <label for="image-preview" class= "align-middle text-black fs-6 fw-bold">Image Preview:</label>
                    <img id="image-preview" src="#" alt="Image Preview" class="img-fluid mt-3 mx-auto " style="display: none; max-width: 100%; height: auto;">
                </div>
            </div>
 </div>

</div>
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
