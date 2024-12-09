<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


Route::get('/', [ItemController::class, 'dashboard'])->name('dashboard');
Route::post('/cart/applyReferral', [CartController::class, 'applyReferral'])->name('cart.applyReferral');
Route::post('/cart/remove-discount', [CartController::class, 'removeDiscount'])->name('cart.removeDiscount');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::resource('items', ItemController::class);
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{item}', [CartController::class, 'add'])->name('cart.add');
  
    Route::patch('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::patch('/order/updateStatus/{order}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

    Route::get('/orders/monthly-report', [OrderController::class, 'generateMonthlyReport'])->name('orders.monthlyReport');
    
    Route::patch('/items/{id}/updateStatus', [ItemController::class, 'updateStatus'])->name('items.updateStatus');
});

require __DIR__.'/auth.php';
