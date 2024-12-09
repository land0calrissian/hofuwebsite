@include('header')
@extends('layouts.app')
@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Orders</h1>
           
        </div>
<!-- Filter Button and searchhh Start -->
<div class="container mb-4 mt-3">
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
   @if (auth()->user()->role == 2)
    <form action="{{ route('order.index') }}" method="GET" class="d-flex justify-content-between mt-4">
        <div class="input-group w-25 me-2">
            <input type="month" class="form-control" name="month" value="{{ request('month') }}">
            <button type="submit" class="btn btn-primary">Filter by Month</button>
        </div>
     
            <div class="input-group w-25">
                <input type="text" class="form-control" name="order_id" placeholder="Order ID" value="{{ request('order_id') }}">
                <button type="submit" class="btn btn-primary">Search by ID</button>
            </div>
    </form>
    <form action="{{ route('orders.monthlyReport') }}" method="GET" class="mt-3">
        <input type="hidden" name="month" value="{{ request('month') }}">
        <button type="submit" class="btn btn-secondary">Generate Monthly Report PDF</button>
    </form>
        @endif
</div>
<div class="container mt-3">
  <h2 class="mb-4 fs-3">Orders List</h2>
  
  <!-- Order 1 -->

  @foreach ($orders as $order)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                 <span>Order ID: {{ $order->id }}</span>
                 <span>{{ $order->created_at->format('d M Y, h:i A') }}</span>

            </div>
            <div class="card-body">
                <p class=""><strong>User Name:</strong> {{ $order->user->name }}</p>
                <p class="card-title fw-bold">Items:</p>
                <ul class="list-group">
                    @foreach ($order->items as $orderItem)
                        <li class="list-group-item">
                           {{ $orderItem->item->name }} - Qty: {{ $orderItem->quantity }} - Note: {{ $orderItem->note }} - Rp{{number_format($orderItem->item->price * $orderItem->quantity, 0, ',', '.') }} 
                        </li>
                    @endforeach
                </ul>
                <p class="mt-2"><strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="mt-2"><strong>Status: </strong> {{ $order->status == 0 ? 'Not Paid' : 'Paid' }}</p>
                 @if (auth()->user()->role == 2)
                 
                    <form action="{{ route('order.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH') 
                        <div class = "d-flex  align-items-center justify-content-between">
                      
                        <select name="status" class="form-control form-control-sm mt-2 " onchange="this.form.submit()" style = "max-width: 100px">
                        
                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Not paid</option>
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Paid</option>
                        </select>
                        </form>
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ms-2 mt-2">Delete Order</button>
                        </form>
                        </div>
                @endif
            </div>
        </div>
    @endforeach

  
  

</div>
@endsection