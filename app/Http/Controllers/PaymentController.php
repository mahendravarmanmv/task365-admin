<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function adminIndex()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(20);
        return view('payments.index', compact('payments'));
    }
}

