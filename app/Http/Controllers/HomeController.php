<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
}
