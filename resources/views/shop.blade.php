
@include('header')
@extends('layouts.app')
@section('content')
        <!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
<h1 class="text-center text-white display-6">Welcome to Hofu Coffee!</h1>
</div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-3">
            <div class="container py-3">
                <h1 class="mb-4 text-left text-black fs-3  text-center">Coffee - Non Coffee - Foods</h1>
                <div class="row g-4 py-3">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                
                            </div>
                             
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                @foreach ($categories as $category)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('dashboard', ['category' => $category['id']]) }}">
                                                            <i class="fas fa-apple-alt me-2"></i>{{ $category['name'] }}
                                                        </a>
                                                        <span>({{ $category['count'] }})</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                       
                                    </div>
                                    <div class="col-lg-12">
                                        
                                    </div>
                                    <div class="col-lg-12">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    
                                     @foreach ($items as $item)
                                     @if ($item->status != 0)
                                      @php
                                            $categoryMap = [
                                                1 => 'Coffee',
                                                2 => 'Non-Coffee',
                                                3 => 'Foods',
                                                // Add more categories as needed
                                            ];
                                        @endphp
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item ">
                                                <div class="fruite-img">
                                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $item->name }}">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $categoryMap[$item->category] }}</div>
                                                <div class="d-flex flex-column p-4 border border-secondary border-top-0 rounded-bottom " style= "min-height: 300px;">
                                                    <h4>{{ $item->name }}</h4>
                                                    <p>{{ $item->description }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
                                                        <p class="text-dark fs-5 fw-bold mb-0">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                                       <button type="button" class="btn border border-secondary rounded-pill px-3 text-primary mt-1" data-toggle="modal" data-target="#addToCartModal-{{ $item->id }}">
                                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                        </button>
                                                        {{-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->






        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

{{-- modal --}}
@foreach ($items as $item)
<div class="modal fade" id="addToCartModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel-{{ $item->id }}">Add to Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity-{{ $item->id }}">Quantity</label>
                        <input type="number" class="form-control" id="quantity-{{ $item->id }}" name="quantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="note-{{ $item->id }}">Notes</label>
                        <textarea class="form-control" id="note-{{ $item->id }}" name="note"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
        
    <!-- JavaScript Libraries -->
 

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


@endsection