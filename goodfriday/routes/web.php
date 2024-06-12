<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController; // Ensure you import the controller correctly

// Existing GET route for the index page
Route::get('/', [PaymentController::class, 'index'])->name('index');

// New POST route for the checkout process
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');

// Existing GET route for the success page
Route::get('/succeed', [PaymentController::class, 'succeed'])->name('succeed');
