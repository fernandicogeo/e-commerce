@extends('layout')

@section('title', 'Login')

@section('login', 'active')

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
    <header class="home-area overlay" id="home_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <img src="{{ asset('style/images/logo-name.png') }}" alt="Logo">
                    <div class="space-70"></div>
                </div>
                <div class="col-xs 12 col-md-7 mt-5">
                    <form class="mb-5 mt-5">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #2B4A9D;">Login</button>
                    </form>
                    <p>Belum memiliki akun? Klik <a href="{{ route('register') }}">disini.</a></p> 
                </div>
            </div>
        </div>
    </header>


@endsection