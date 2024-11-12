<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;


Route::get('/', [ItemController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::resource('items', ItemController::class);
    Route::get('/users', [UserController::class, 'index'])->name('user.index');


    Route::patch('/items/{id}/updateStatus', [ItemController::class, 'updateStatus'])->name('items.updateStatus');
});

require __DIR__.'/auth.php';
