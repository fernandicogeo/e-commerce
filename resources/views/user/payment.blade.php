@extends('layout')

@section('title', 'Payment')

@section('payment', 'active')

@section('isi')
  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

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
                <h4 class="title wow" style="color: white">Pembayaran</h4>
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
                        <tr>
                            <td></td>
                            <th>Total</th>
                            <td></td>
                            <td></td>
                            <td>{{ $payment->total_price }}</td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="row justify-content-end">
                <div class="col-auto">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="pay-button">Bayar</button>
                </div>
                <div class="col-auto">
                    <form action="{{ route('payment.cancel', $payment->id) }}" method="post" class="d-inline"> 
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form> 
                </div>
            </div>
            
            </div>
        </div>
    </header>
    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
          </div>
          <div class="modal-body justify-content-center d-flex align-items-center">
            <div id="snap-container"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
        // Also, use the embedId that you defined in the div above, here.
        window.snap.embed('{{ $snapToken }}', {
          embedId: 'snap-container',
          onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function (result) {
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function (result) {
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function () {
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        });
      });
    </script>
@endsection