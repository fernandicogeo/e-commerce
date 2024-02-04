@extends('layout')

@section('title', 'Home')

@section('home', 'active')

@section('isi')

    <!-- MainMenu-Area-End -->
    <!-- Home-Area -->
    <header class="home-area overlay" id="home_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <img src="{{ asset('style/images/logo-name.png') }}" alt="Logo">
                    <div class="space-70"></div>
                </div>
                <div class="col-xs 12 col-md-7 mt-5">
                    <h1 class="wow" style="font-weight: bold">Selamat Datang di Website Easy Data!</h1>
                    <div class="desc wow">
                        Easy Data merupakan jasa konsultasi data berbasis web yang bergerak dalam didang pengolahan data dan analisis data serta kursus untuk menunjang dan mengurangi ketidakmahiran dalam penggunaan software pengolahan data.
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Home-Area-End -->
    
    <!-- About-Area -->
    <section class="section-padding">
        <div class="container text-center">
            <h2 class="wow" style="font-weight: bold;color:#2B4A9D">Items</h2>
            <div class="row justify-content-center">
                @foreach ($items as $item)
                <div class="card m-3" style="max-width: 30%;">
                    <a href="{{ route('item.detail', $item->id) }}">
                        <img src="{{ asset('style/images/logo-name.png') }}" alt="Logo" class="card-img-top">
                        <div class="card-body text-center">
                            <h4 style="font-weight: bold">{{ $item->name }}</h4>
                            <p class="card-text">Harga : {{ $item->price }}, Stock : {{ $item->stock }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- About-Area-End -->


@endsection