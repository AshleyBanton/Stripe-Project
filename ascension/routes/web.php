<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionController;


/* Routes for the pages */
Route::get('/', function () {
    return view('test');
});

Route::get('products', function () {
    return view('products');
});

Route::get('subscription', function () {
    return view('subscription');
});

Route::get('pricing', function () {
    return view('pricing');
});

Route::get('subscription', function () {
    return view('subscription');
});



/* Routes for the classes in the controllers */
Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::post('cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

