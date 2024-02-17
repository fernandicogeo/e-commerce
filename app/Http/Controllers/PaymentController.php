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
            ->where('isDeleted', 0)
            ->where('isActived', 2)
            ->get();

        $payment = Payment::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();

        if ($payment != null) {
            // MidTrans
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $payment->id,
                    'gross_amount' => $payment->total_price,
                ),
                'customer_details' => array(
                    'id' => $payment->user_id,
                    'name' => $payment->user_name,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return view('user.payment', compact('cart', 'payment', 'snapToken'));
        } else return redirect(route('home'));
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

        $payment = Payment::create($validatedData);
        // update payment_id dan payment_total_price
        $cartIdsArray = explode(', ', $validatedData['cart_ids']);

        foreach ($cartIdsArray as $cartId) {
            $cartItem = Cart::where('id', $cartId)->first();

            $cartItem->update([
                'payment_id' => $payment->id,
                'payment_total_price' => $payment->total_price,
            ]);
        }
        return redirect(route('payment'));
    }


    public function cancel($id)
    {
        $payment = Payment::where('id', $id)
            ->where('status', 0)
            ->first();

        $payment->update([
            'status' => '1',
        ]);

        $cartIdsArray = explode(', ', $payment->cart_ids);

        foreach ($cartIdsArray as $cartId) {
            $cartItem = Cart::where('id', $cartId)
                ->where('isActived', 2)
                ->first();

            $cartItem->update([
                'isActived' => '1',
            ]);
        }

        return redirect(route('cart'))->with('pesan', 'Anda berhasil membatalkan pembayaran.');
    }

    public function success(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $payment = Payment::find($request->order_id);

                $cartIdsArray = explode(', ', $payment->cart_ids);
                foreach ($cartIdsArray as $cartId) {
                    $cartItem = Cart::where('id', $cartId)
                        ->where('isActived', 2)
                        ->first();

                    $cartItem->update([
                        'isActived' => '3',
                    ]);
                }
                $payment->update(['status' => '2']);
            }
        }
    }
}
