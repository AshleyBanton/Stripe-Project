<?php

namespace App\Http\Controllers;

/* Price of the product */

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51P93FuCJFztwL0BqfChloaKqATpVwLhL3efSfT9KvXUVI5VHMDU4SZYYaBZXWXMBvuHDUMDGzUtzr8UeW25MbkYW00nYpeR3gm');

$response = $stripe->checkout->sessions->create([
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'chf',
        'product_data' => ['name' => 'T-shirt'],

        /*Determine the price of the product*/
        'unit_amount' => 1000,

        'tax_behavior' => 'exclusive',
      ],
      'adjustable_quantity' => [
        'enabled' => true,
        'minimum' => 1,
        'maximum' => 1000,
      ],
      'quantity' => 1,
    ],
  ],
  'automatic_tax' => ['enabled' => true],
  'mode' => 'payment',
  'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => route('cancel')
]);


if(isset($response->id) && $response->id != ''){
    session()->put('product_name', $request->product_name);
    session()->put('quantity', $request->quantity);
    session()->put('price', $request->price);
    return redirect($response->url);
}else{
    return redirect()->route('cancel');
}


    }

    public function success()
    {
        return "Success";
    }

    public function cancel()
    {
        return "Cancel";
    }
}
