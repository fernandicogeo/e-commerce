@extends('layout')

@section('title', 'Cart')

@section('cart', 'active')

@section('isi')

<style>
    body {
        background-color: #768ede;
    }

    a:hover {
        color: #2B4A9D;
    }
</style>
    <!-- Home-Area -->
    <header class="home-area overlay" id="home_page" style="margin-bottom: 350px">
        <div class="container">
            <div class=" row page-title text-center mt-3">
                <h4 class="title wow" style="color: white">Keranjang</h4>
            </div>
            <div class="row">
                <div style="overflow-x:auto;">
                <table class="table table-striped table-primary">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Item</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga satuan</th>
                        <th scope="col">Harga Total Item</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $totalprice = 0; 
                        $cart_ids = [];?>
                        @foreach ($cart as $cart)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $cart->item_name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->price }}</td>
                            <td>{{ $cart->total_price }}</td>
                            <?php $totalprice += $cart->total_price; 
                            $cart_ids[] = $cart->id;?>
                            <td>
                                {{-- EDIT CART --}}
                                    <a href="{{ route('edit.cart', $cart->id) }}" class="btn btn" data-toggle="modal"><i class="fa-solid fa-pen-to-square" style="color: #F0AD4E" title="Edit"></i></a>
                                </form>
                                {{-- DELETE CART --}}
                                <form action="{{ route('delete.cart', $cart->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn"><i class="fa-solid fa-trash" style="color: #E04146" title="Hapus"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <th>Total</th>
                            <td></td>
                            <td></td>
                            <td>{{ $totalprice }}</td>
                            <td>
                                @if ($totalprice != 0)
                                <form action="{{ route('payment.store') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="text" hidden name="user_name" value="{{ Auth::user()->name }}">
                                    <input type="text" hidden name="cart_ids" value="{{ implode(', ', $cart_ids) }}">
                                    <input type="text" hidden name="total_price" value="{{ $totalprice }}">
                                    <button type="submit" class="btn btn"><i class="fa-solid fa-money-check-dollar" style="color: #7DC855" title="Bayar"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </header>


@endsection