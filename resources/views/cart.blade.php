
@include ('header')
@extends('layouts.app')
@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
           
        </div>
<div class="container">
    <div id="alert-placeholder"></div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (count($cartItems) > 0)
      <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($cartItems as $cartItem)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $cartItem->item->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$cartItem->item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp{{ number_format($cartItem->item->price, 0, ',', '.') }}</p>
                                </td>
                                <td>
                                <div class="mb-0 mt-4">
                                <form action="{{ route('cart.update', $cartItem->item_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="btn btn-plus rounded-circle bg-light border btn-sm">-</button>
                                </form>
                                
                                <span>{{ $cartItem->quantity }}</span>
                                <form action="{{ route('cart.update', $cartItem->item_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="btn btn-plus rounded-circle bg-light border btn-sm">+</button>
                                </form>
                                </div>
                                </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ number_format($cartItem->item->price * $cartItem->quantity, 0, ',', '.') }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$cartItem->note}}</p>
                                </td>
                                <td>
                                    <form action="{{ route('cart.remove', $cartItem->item_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                    </form>
                                </td>
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0">Total: Rp <span id="total-price">{{ number_format($cartItems->sum(function($cartItem) { return $cartItem->item->price * $cartItem->quantity; }), 0, ',', '.') }}</span></p>
                                </div>
                                {{-- <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: $3.00</p>
                                    </div>
                                </div>
                                <p class="mb-0 text-end">Shipping to Ukraine.</p> --}}
                            </div>
                            {{-- <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4">$99.00</p>
                            </div> --}}
                            <form action="{{ route('order.create') }}" method="POST">
                                @csrf
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="submit">Proceed Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->


        <!-- Footer Start -->
        


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

@endsection
