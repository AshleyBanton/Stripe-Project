<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function allPlans()
        {
            // Fetch the plans from Stripe
            $plans = Plan::get();

            // Pass the variables to the view
            return view('plans', compact('plans'));
        }
}
