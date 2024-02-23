<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $payment = Payment::where('status', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', compact('payment'));
    }

    public function index_unpaid()
    {
        $payment = Payment::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.unpaid', compact('payment'));
    }

    public function index_canceled()
    {
        $payment = Payment::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.canceled', compact('payment'));
    }

    public function index_users()
    {
        $user = User::where('role', 'user')
            ->get();

        return view('dashboard.users', compact('user'));
    }

    public function index_items()
    {
        $item = Item::get();

        return view('dashboard.items', compact('item'));
    }

    public function add_item(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Item::create($validatedData);

        return redirect(route('dashboard.items'))->with('pesan', 'Anda berhasil menambahkan item ' . $request->name);
    }

    public function edit_item($id)
    {
        $item = Item::where('id', $id)->first();
        return view('dashboard.edit-item', compact('item'));
    }

    public function update_item(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Item::where('id', $request->id)
            ->update($validatedData);

        return redirect(route('dashboard.items'))->with('pesan', 'Anda berhasil mengupdate item ' . $request->name);
    }

    public function delete_item($id)
    {
        $item = Item::where('id', $id)->first();
        $item->delete();
        return redirect(route('dashboard.items'))->with('pesan', 'Anda berhasil menghapus item ' . $item->name);
    }

    public function logout()
    {
        $redirect = "";

        if (Auth::user()->role === "admin") {
            $redirect = 'login';
        } else {
            $redirect = 'home';
        }

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect(route($redirect));
    }
}
