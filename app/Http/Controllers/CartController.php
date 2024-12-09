<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    //
   
        
    public function index()
    {
        $cartItems = Cart::with('item')->where('user_id', auth()->id())->get();
        $referralUser = null;
        if (session()->has('referral_user_id')) {
            $referralUser = User::find(session('referral_user_id'));
        }
        return view('cart', compact('cartItems', 'referralUser'));
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
        // Recalculate the total price and apply discount if referral code is present
        $this->recalculateCartTotal();
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

    
    public function applyReferral(Request $request)
    {
    $user = auth()->user();
    $request->validate([
        'referral_code' => 'required|string',
    ]);
    //user yang referral codenya diisi
    $referralUser = User::where('referral_code', $request->referral_code)->first();
    
    if ($referralUser) {
        if ($referralUser->id == $user->id) { //pastikan bukan referal diri sendiri
            return redirect()->route('cart.index')->with('error', 'You cannot use your own referral code.');
        }
        session(['referral_user_id' => $referralUser->id]);
        $this->recalculateCartTotal();
      
            return redirect()->route('cart.index')->with('success', 'Referral code applied successfully. 10% discount will be applied.');
        
    }
    else{
        return redirect()->route('cart.index')->with('error', 'Invalid referral code.');}
    }
     
    

    private function recalculateCartTotal()
    {
        $cartItems = Cart::with('item')->where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function($cartItem) {
            return $cartItem->item->price * $cartItem->quantity;
        });

        if (session()->has('referral_user_id')) {
            $discountedTotal = $totalPrice * 0.9; // Apply 10% discount
            session(['discounted_total' => $discountedTotal]);
        } else {
            session(['discounted_total' => $totalPrice]);
        }

       
    }
    public function removeDiscount(Request $request)
    {
        $request->session()->forget('referral_user_id');
        $request->session()->forget('discounted_total');

        $this->recalculateCartTotal();

        return redirect()->route('cart.index')->with('success', 'Discount removed successfully.');
    }
}


