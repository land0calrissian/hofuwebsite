<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $month = $request->input('month');
        $orderId = $request->input('order_id');
        $ordersQuery = Order::with(['items.item', 'user'])->orderBy('created_at', 'desc'); // base query

        if (auth()->user()->role == 2) {
            // Admin: Fetch all orders or search by ID
            if ($orderId) {
                $ordersQuery->where('id', $orderId);    
            } elseif ($month) {
                $startDate = Carbon::parse($month)->startOfMonth();
                $endDate = Carbon::parse($month)->endOfMonth();
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        } else {
            // User: Fetch only their orders
            $ordersQuery->where('user_id', auth()->id());

            // Apply month filter if month is present
            if ($month) {
                $startDate = Carbon::parse($month)->startOfMonth();
                $endDate = Carbon::parse($month)->endOfMonth();
                $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        // Get the filtered orders
        $orders = $ordersQuery->get();

    //     return view('order', compact('orders'));
        return view('order', compact('orders', 'month', 'orderId'));
    }
    public function create(Request $request){
        $cartItems = Cart::with('item')->where('user_id', auth()->id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }


        if (session()->has('discounted_total')) {
            $totalPrice = session('discounted_total');
        } else {
            // Calculate total price
            $totalPrice = $cartItems->sum(function($cartItem) {
                return $cartItem->item->price * $cartItem->quantity;
            });
        }
     

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 0,
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $cartItem->item_id,
                'quantity' => $cartItem->quantity,
                'note' => $cartItem->note,
                //'price' => $cartItem->item->price,
            ]);
        }
        
        // Clear the cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.index')->with('success', 'Order placed successfully. Please go to the cashier to proccess payment');
    }
    public function updateStatus(Request $request, Order $order)
    {
        if (auth()->user()->role != 2) {
            return redirect()->route('order.index', $order->id)->with('error', 'You are not authorized to change the status.');
        }

        $request->validate([
            'status' => 'required|integer|in:0,1',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('order.index', $order->id)->with('success', 'Order status updated successfully.');
    }
    
    public function destroy (Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }
}
