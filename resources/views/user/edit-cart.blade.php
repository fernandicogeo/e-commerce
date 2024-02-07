@extends('layout')

@section('title', 'Edit Cart')

@section('cart', 'active')

@section('isi')

<style>

    a:hover {
        color: #2B4A9D;
    }
    .row-quant {
        display: flex;
    }

    .col-xs-1,
    .col-xs-2 {
        padding: 0;
        margin: 0;
    }

    .input-group-btn-quant {
        display: flex;
        align-items: center;
    }

    .form-control-quant {
        margin: 0;
    }

    a:hover {
        color: black;
    }
</style>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-column">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                        <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="{{ asset('style/images/logo.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Gambar 1</h5>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="{{ asset('style/images/logo.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Gambar 2</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('style/images/logo.png') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Gambar 3</h5>
                            </div>
                        </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-column">
                    <div class="mt-5">
                        <?php $harga = 0; ?>
                        
                        <form class="mb-5 mt-5" action="{{ route('update.cart') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @foreach ($item as $item)
                            <div class="product-description">
                                <span>Produk</span>
                                <h1>{{ $item->name }}</h1>
                                <p>{{ $item->description }}</p>
                            </div>
                            <div class="product-configuration">
                                <div class="cable-config">
                                    <span>Kuantitas, Stok : {{ $item->stock }}</span>
                                    <div class="row-quant">
                                        <div class="">
                                            <span class="input-group-btn-quant">
                                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                <span class="glyphicon glyphicon-minus" style="color: white"></span>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="">
                                            <input type="text" name="quantity" class="form-control input-number" value="{{ $cart->quantity }}" min="1" max="{{ $item->stock }}" style="width: 60px">
                                        </div>
                                        <div class="">
                                            <span class="input-group-btn-quant">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-plus" style="color: white"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden name="item_name" value="{{ $item->name }}">
                            <input type="text" hidden name="price" value="{{ $item->price }}">
                            <input type="text" hidden name="item_id" value="{{ $item->id }}">
                            <div class="product-price">
                                <span id="price">Rp{{ number_format($cart->total_price) }}</span>
                                <button class="btn btn-submit cart-btn">Update keranjang</button>
                            </div>
                            <?php $harga = $item->price;
                            ?>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updatePrice() {
        var quantity = parseInt($("input[name='quantity']").val());
        var price = {{ $harga }}; // Initial price
        var totalPrice = quantity * price;
        $("#price").text("Rp" + totalPrice.toLocaleString('en-US'));
    }

    $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='quantity']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == 'minus') {
            if (currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }

            // Enable the "plus" button when the quantity is less than max
            $(".btn-number[data-type='plus'][data-field='" + fieldName + "']").removeAttr('disabled');
        } else if (type == 'plus') {
            if (currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }

            // Enable the "minus" button when the quantity is greater than min
            $(".btn-number[data-type='minus'][data-field='" + fieldName + "']").removeAttr('disabled');
        }
    } else {
        input.val(0);
    }

    // Update the price when quantity changes
    updatePrice();
    
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    updatePrice();
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


@endsection