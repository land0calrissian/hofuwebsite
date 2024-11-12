@include('header')

@extends('layouts.app')

@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Edit Item Form</h1>
           
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
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                     <div class="row text-black fw-bold">
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Item Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $item->description }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image">Image</label>
                            <input class="mt-3" type="file" class="form-control" id="image" name="image"onchange="previewImage(event)">
                            
                        </div>
                        <div class="form-group mt-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required>
                        </div>
                        <div class="form-group mt-3 mb-5">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="1" {{ $item->category == 1 ? 'selected' : '' }}>Coffee</option>
                                <option value="2" {{ $item->category == 2 ? 'selected' : '' }}>Non-Coffee</option>
                                <option value="3" {{ $item->category == 3 ? 'selected' : '' }}>Foods</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="form-group mt-3 mb-5 text-center">
                          <label for="image-preview" class= "align-middle text-black fs-6 fw-bold">Image Preview:</label>
                          <img id="image-preview" src="{{ $item->image ? asset('storage/' . $item->image) : '#' }}" alt="Image Preview" class="img-fluid mt-3 mx-auto d-block" style="display: {{ $item->image ? 'block' : 'none' }};">
                        </div>
                    </div>
            </div>
        </form>
       
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