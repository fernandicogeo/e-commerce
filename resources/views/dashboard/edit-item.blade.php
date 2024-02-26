@extends('dashboard.partials.layout')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Item {{ $item->name }}</h1>
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
          <div class="col-lg-8 mb-5">
            <form action="{{ route('update.item') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama item</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $item->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi item</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $item->description }}" required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga item</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $item->price }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok item</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" required id="stock" name="stock" value="{{ intval($item->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>       
                <div class="mb-3">
                    <label for="pic1" class="form-label">Foto 1 item</label><small> Max: 2MB (Kosongkan jika tidak ingin mengubah gambar)</small>
                    <input type="file" class="form-control @error('pic1') is-invalid @enderror" id="pic1" name="pic1" value="{{ old('pic1') }}">
                    @error('pic1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pic2" class="form-label">Foto 2 item</label><small> Max: 2MB (Kosongkan jika tidak ingin mengubah gambar)</small>
                    <input type="file" class="form-control @error('pic2') is-invalid @enderror" id="pic2" name="pic2" value="{{ old('pic2') }}">
                    @error('pic2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pic3" class="form-label">Foto 3 item</label><small> Max: 2MB (Kosongkan jika tidak ingin mengubah gambar)</small>
                    <input type="file" class="form-control @error('pic3') is-invalid @enderror" id="pic3" name="pic3" value="{{ old('pic3') }}">
                    @error('pic3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>      
                <input type="hidden" name="id" value="{{ $item->id }}">   
                <button type="submit" class="btn btn-primary">Edit</button>
              </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

  