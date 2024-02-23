@extends('dashboard.partials.layout')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pembeli (Unpaid)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Dashboard Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div style="overflow-x:auto;">
            <table class="table table-striped table-secondary">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">ID User</th>
                    <th scope="col">Email User</th>
                    <th scope="col">Item</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($payment as $payment)
                    @php
                        $user = \App\Models\User::where('id', $payment->user_id)->first();
                        $carts = \App\Models\Cart::whereIn('id', explode(',', $payment->cart_ids))->get();
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $payment->user_name }}</td>
                        <td>{{ $payment->user_id }}</td>
                        <td>
                          {{ $user->email }}
                        </td>
                        <td>
                          <ul>
                              @foreach ($carts as $cart)
                                  <li>{{ $cart->item_name }} ({{ $cart->quantity }})</li> 
                              @endforeach
                          </ul>
                        </td>
                        <td>{{ $payment->total_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

  