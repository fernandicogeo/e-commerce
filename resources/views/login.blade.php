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

    @if (session()->has('pesan'))
    <script>
        alert("{{ session('pesan') }}")
    </script>
    @elseif (session()->has('loginError'))
    <script>
    alert("{{ session('loginError') }}")
    </script>
    @endif
    <!-- Home-Area -->
    <header class="home-area overlay" id="home_page">
        <div class="container">
            <div class=" row page-title text-center mt-3">
                <h4 class="title wow" style="color: white">Login</h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <img src="{{ asset('style/images/logo-name.png') }}" alt="Logo" class="img-padbot">
                </div>
                <div class="col-xs 12 col-md-7 mt-5">
                    <form class="mb-5 mt-5" action="{{ route('login.authenticate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label @error('email') is-invalid @enderror">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label @error('password') is-invalid @enderror">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #2B4A9D;">Login</button>
                    </form>
                    <p>Belum memiliki akun? Register <a href="{{ route('register') }}">disini.</a></p> 
                </div>
            </div>
        </div>
    </header>


@endsection