<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('index', compact('items'));
    }

    public function index_contact_us()
    {
        $items = Item::all();
        return view('contact-us', compact('items'));
    }

    public function item_detail($id)
    {
        $item = Item::where('id', $id)->get();
        return view('item-detail', compact('item'));
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|numeric',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|max:255',
        ]);

        $validatedDataUser['name'] = $validatedData['name'];
        $validatedDataUser['nik'] = $validatedData['nik'];
        $validatedDataUser['email'] = $validatedData['email'];
        $validatedDataUser['password'] = bcrypt($validatedData['password']);
        $validatedDataUser['role'] = "user";

        User::create($validatedDataUser);

        return redirect(route('login'))->with('pesan', 'Anda berhasil registrasi');
    }
}
