<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.cart', compact('cart'));
    }

    public function store(Request $request)
    {
        // dd($request->item_name, $request->quantity, $request->price);
        $validatedData = $request->validate([
            'item_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'item_id' => 'required',
        ]);

        $validatedData['total_price'] = $validatedData['quantity'] * $validatedData['price'];
        $validatedData['isDeleted'] = 0;
        $validatedData['isActived'] = 0;
        $validatedData['user_id'] = Auth::user()->id;

        $cartItem = Cart::where('item_id', $validatedData['item_id'])->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $validatedData['quantity'],
                'total_price' => $cartItem->total_price + $validatedData['total_price']
            ]);
        } else {
            Cart::create($validatedData);
        }

        return back()->with('pesan', 'Anda berhasil menambahkan ' . $request->item_name . ' ke keranjang.');
    }
}
