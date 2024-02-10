<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('isActived', 2)
            ->get();

        $payment = Payment::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        if ($payment != null) return view('user.payment', compact('cart', 'payment'));
        else return redirect(route('home'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'user_name' => 'required',
            'cart_ids' => 'required',
            'total_price' => 'required',
        ]);

        $validatedData['status'] = '0'; //unpaid

        $cartIdsArray = explode(', ', $validatedData['cart_ids']);

        foreach ($cartIdsArray as $cartId) {
            $cartItem = Cart::where('id', $cartId)
                ->where('isDeleted', 0)
                ->where('isActived', 0)
                ->first();

            $cartItem->update(['isActived' => '2']);
        }

        Payment::create($validatedData);

        return redirect(route('payment'));
    }
}
