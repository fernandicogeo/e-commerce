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
                        @foreach ($cart as $cart)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $cart->item_name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->price }}</td>
                            <td>{{ $cart->total_price }}</td>
                            <td>
                                {{-- EDIT CART --}}
                                    <a href="{{ route('edit.cart', $cart->id) }}" class="btn btn" data-toggle="modal"><i class="fa-solid fa-pen-to-square" style="color: #F0AD4E" title="edit"></i></a>
                                </form>
                                {{-- DELETE CART --}}
                                <form action="{{ route('delete.cart', $cart->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn"><i class="fa-solid fa-trash" style="color: #E04146" title="delete"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </header>


@endsection