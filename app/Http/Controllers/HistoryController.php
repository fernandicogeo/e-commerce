<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('isActived', '3')
            ->get();

        $payment = Payment::where('user_id', Auth::user()->id)
            ->where('status', '2')
            ->get();

        return view('user.history', compact('cart', 'payment'));
    }
}
