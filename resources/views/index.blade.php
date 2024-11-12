@include ('header')
@extends('layouts.app')

@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Items</h1>
           
        </div>

<div class="container-fluid pt-2">
    {{-- <h1>Items</h1> --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
      <div class="d-flex justify-content-end mb-3">
        <p class = "fs-3 mx-auto fw-bold text-black">List of Items</p>
      
        <a href="{{ route('items.create') }}" class="btn btn-primary text-bold">Create Item</a>
    </div>


    <table id="itemsTable" class="display table table-bordered border-dark">
        <thead>
            <tr class = "text-black text-center fw-bold">
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                
                <th>Price</th>
                <th>Status</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr class = "text-black text-center">
                <td class = "align-middle text-center" style = "width: 250px;"><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"  class = "img-fluid w-150 p-3"></td>
                <td style = "width: 150px">{{ $item->name }}</td>
                <td style = "width: 550px">{{ $item->description }}</td>
                
                <td style = "width: 100px">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                <td style = "width:150px">
                    <form action="{{ route('items.updateStatus', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select style="width: 110px" class="form-control mx-3" name="status" onchange="this.form.submit()">
                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </form>
                </td>
                <td style = "width: 150px">
                    @if ($item->category == 1)
                        Coffee
                    @elseif ($item->category == 2)
                        Non-Coffee
                    @else
                        Foods
                    @endif
                </td>
                <td>
                <div class="d-flex flex-column align-items-center" style = "width: 150px">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn btn-outline-primary mb-1" style = "width: 75px;">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn btn-outline-primary">Delete</button>
                    </form>
                
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
$(document).ready(function() {
    $('#itemsTable').DataTable();
});
</script>
@endsection

