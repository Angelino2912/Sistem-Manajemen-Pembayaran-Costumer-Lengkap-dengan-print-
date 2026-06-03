<?php

namespace App\Http\Controllers;

class CustomerPaymentController extends Controller
{
    public function create()
    {
        return view('Customer.payment-form');
    }
}
