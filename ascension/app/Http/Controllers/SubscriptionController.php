<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        \Stripe\Stripe::setApiKey('sk_test_51P93FuCJFztwL0BqfChloaKqATpVwLhL3efSfT9KvXUVI5VHMDU4SZYYaBZXWXMBvuHDUMDGzUtzr8UeW25MbkYW00nYpeR3gm');

        $priceId = 'price_1PQzZcCJFztwL0BqF8ULDNot';

        $session = \Stripe\Checkout\Session::create([
          'success_url' => 'https://example.com/success.html?session_id={CHECKOUT_SESSION_ID}',
          'cancel_url' => 'https://example.com/canceled.html',
          'mode' => 'subscription',
          'line_items' => [[
            'price' => $priceId,
            // For metered billing, do not pass quantity
            'quantity' => 1,
          ]],
        ]);


// dd($session);

if(isset($session->id) && $session->id != ''){
    return redirect($session->url);
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
