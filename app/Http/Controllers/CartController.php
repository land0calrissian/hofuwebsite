<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\User;
class CartController extends Controller
{
   
    public function index()
    {
        $cartItems = Cart::with('item')->where('user_id', auth()->id())->get();
        
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, Item $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);
        //dd($request->all());
        Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'item_id' => $item->id],
            ['quantity' => $request->quantity, 'note' => $request->note]
        );

        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully.');
    }
    
    public function update(Request $request, $itemId)
    {
       
        $cartItem = Cart::where('user_id', auth()->id())->where('item_id', $itemId)->first();
        if ($cartItem) {
            if ($request->action == 'increase') {
                $cartItem->increment('quantity');
            } elseif ($request->action == 'decrease') {
                if ($cartItem->quantity > 1) {
                    $cartItem->decrement('quantity');
                } else {
                    $cartItem->delete();
                }
            } 
        }
        
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function remove($itemId)
    {
        $cartItem = Cart::where('user_id', auth()->id())->where('item_id', $itemId)->first();
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }

   
}


