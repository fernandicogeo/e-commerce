<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
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
            'pic1' => 'required|image|max:2048',
            'pic2' => 'required|image|max:2048',
            'pic3' => 'required|image|max:2048',
        ]);

        $item = Item::create($validatedData);

        Carbon::setLocale('id');
        Carbon::setToStringFormat('Y-m-d_H-i-s');

        $now = Carbon::now('Asia/Jakarta');
        $timestamp = $now->format('Y-m-d_H-i-s');

        $pic1 = $request->file('pic1')->storeAs('public', $request->name . '_' . $timestamp . '_pic1.' . $request->file('pic1')->getClientOriginalExtension());
        $pic2 = $request->file('pic2')->storeAs('public', $request->name . '_' . $timestamp . '_pic2.' . $request->file('pic2')->getClientOriginalExtension());
        $pic3 = $request->file('pic3')->storeAs('public', $request->name . '_' . $timestamp . '_pic3.' . $request->file('pic3')->getClientOriginalExtension());

        $item->update([
            'pic1' => basename($pic1),
            'pic2' => basename($pic2),
            'pic3' => basename($pic3),
        ]);

        return redirect(route('dashboard.items'))->with('pesan', 'Anda berhasil menambahkan item ' . $request->name);
    }

    public function edit_item($id)
    {
        $item = Item::where('id', $id)->first();
        return view('dashboard.edit-item', compact('item'));
    }

    public function update_item(Request $request)
    {
        $pic1Validation = $pic2Validation = $pic3Validation = 'nullable|image|max:2048';
        Carbon::setLocale('id');
        Carbon::setToStringFormat('Y-m-d_H-i-s');

        $now = Carbon::now('Asia/Jakarta');
        $timestamp = $now->format('Y-m-d_H-i-s');

        if ($request->hasFile('pic1')) {
            $pic1Validation = 'required|image|max:2048';
        }

        if ($request->hasFile('pic2')) {
            $pic2Validation = 'required|image|max:2048';
        }

        if ($request->hasFile('pic3')) {
            $pic3Validation = 'required|image|max:2048';
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'pic1' => $pic1Validation,
            'pic2' => $pic2Validation,
            'pic3' => $pic3Validation,
        ]);

        if ($request->hasFile('pic1')) {
            $pic1 = $request->file('pic1')->storeAs('public', $request->name . '_' . $timestamp . '_pic1.' . $request->file('pic1')->getClientOriginalExtension());
            $validatedData['pic1'] = basename($pic1);
        }
        if ($request->hasFile('pic2')) {
            $pic2 = $request->file('pic2')->storeAs('public', $request->name . '_' . $timestamp . '_pic2.' . $request->file('pic2')->getClientOriginalExtension());
            $validatedData['pic2'] = basename($pic2);
        }
        if ($request->hasFile('pic3')) {
            $pic3 = $request->file('pic3')->storeAs('public', $request->name . '_' . $timestamp . '_pic3.' . $request->file('pic3')->getClientOriginalExtension());
            $validatedData['pic3'] = basename($pic3);
        }

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
