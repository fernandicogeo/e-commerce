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
            <div class=" row page-title text-center mt-3">
                <h4 class="title wow" style="color: white">Register</h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <img src="{{ asset('style/images/logo-name.png') }}" alt="Logo" class="img-padbot">
                </div>
                <div class="col-xs 12 col-md-7 mt-5">
                    <form class="mb-5 mt-5" action="{{ route('register.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="nik" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #2B4A9D;">Register</button>
                    </form>
                    <p>Sudah memiliki akun? Login <a href="{{ route('login') }}">disini.</a></p> 
                </div>
            </div>
        </div>
    </header>


@endsection