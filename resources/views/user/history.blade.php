@extends('layout')

@section('title', 'Riwayat Pembelian')

@section('history', 'active')

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
                <h4 class="title wow" style="color: white">Riwayat Pembelian</h4>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </header>
@endsection