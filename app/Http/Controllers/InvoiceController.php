<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $cart = Cart::where('payment_id', $id)->first();

        $payment = Payment::where('id', $id)->first();

        return view('user.invoice', compact('cart', 'payment'));
    }
}
