<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('isDeleted', 0)
            ->where('isActived', 0)
            ->get();
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
        $validatedData['user_name'] = Auth::user()->name;

        $cartItem = Cart::where('user_id', Auth::user()->id)
            ->where('item_id', $validatedData['item_id'])
            ->where('isDeleted', 0)
            ->where('isActived', 0)
            ->first();

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

    public function edit($id)
    {
        $cart = Cart::where('id', $id)->first();
        $item = Item::where('id', $cart->item_id)->get();
        return view('user.edit-cart', compact('cart', 'item'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'item_id' => 'required',
        ]);

        $validatedData['total_price'] = $validatedData['quantity'] * $validatedData['price'];
        $cartItem = Cart::where('user_id', Auth::user()->id)
            ->where('item_id', $validatedData['item_id'])
            ->where('isDeleted', 0)
            ->where('isActived', 0)
            ->first();

        $cartItem->update([
            'quantity' => $validatedData['quantity'],
            'total_price' => $validatedData['total_price']
        ]);

        return redirect(route('cart'))->with('pesan', 'Anda berhasil mengupdate ' . $request->item_name . ' di keranjang.');
    }

    public function delete($id)
    {
        $cartItem = Cart::where('id', $id)->first();

        $cartItem->update([
            'isDeleted' => '1',
            'isActived' => '1',
        ]);

        return redirect(route('cart'))->with('pesan', 'Anda berhasil menghapus ' . $cartItem->item_name . ' di keranjang.');
    }
}
