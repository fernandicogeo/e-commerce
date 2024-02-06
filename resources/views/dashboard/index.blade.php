@extends('dashboard.partials.layout')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item">Dashboard Visitor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-lg-4" style="width: 10rem;">
                <a href="/profile" style="text-decoration: none; color: black">
                    <img src="/img/profil.png" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h5 class="card-text mt-1 fs-6">Profil Diri</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-4" style="width: 10rem;">
                <a href="/schedule" style="text-decoration: none; color: black">
                    <img src="/img/schedule.png" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h5 class="card-text mt-1 fs-6">Ajukan Pertemuan</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-4" style="width: 10rem;">
                <a href="/history" style="text-decoration: none; color: black">
                    <img src="/img/history.png" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h5 class="card-text mt-1 fs-6">Riwayat</h5>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </section>
  </div>
@endsection

  