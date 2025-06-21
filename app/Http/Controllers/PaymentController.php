<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function adminIndex()
    {
        $payments = Payment::with(['lead.category'])->orderBy('created_at', 'desc')->get();
        return view('payments.index', compact('payments'));
    }
}

