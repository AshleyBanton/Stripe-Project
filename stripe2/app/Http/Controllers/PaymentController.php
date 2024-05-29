<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $user = $request->user();
        $intent = $user->createSetupIntent(); // or createPaymentIntent() for payment intent

        return view('payment.form', compact('intent'));
    }
}
