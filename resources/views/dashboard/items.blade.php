@extends('dashboard.partials.layout')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pembeli (Paid)</h1>
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
        {{-- ADD ITEM --}}
        <a class="btn btn mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-file-earmark-plus-fill" style="color: #198754" title="Add"></i>
        </a>
        
        <div class="row">
          <div style="overflow-x:auto;">
            <table class="table table-striped table-secondary">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Deskripsi Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Stok Barang</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($item as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>
                          <ul>
                            <li><img src="/storage/app/public/{{ $item->pic1 }}" alt="Pic 1" style="max-width: 50px"></li>
                            <li><img src="/storage/app/public/{{ $item->pic2 }}" alt="Pic 2" style="max-width: 50px"></li>
                            <li><img src="/storage/app/public/{{ $item->pic2 }}" alt="Pic 3" style="max-width: 50px"></li>
                          </ul>
                        </td>
                        <td>
                            {{-- EDIT ITEM --}}
                            <a href="{{ route('edit.item', $item->id) }}" class="btn btn">
                                <i class="bi bi-pen-fill" style="color: #F0AD4E" title="Edit"></i>
                            </a>
                            </form>
                            {{-- DELETE ITEM --}}
                            <form action="{{ route('delete.item', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn">
                                    <i class="bi bi-trash3-fill" style="color: #E04146" title="Hapus"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  {{-- MODAL ADD ITEM --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('add.item') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama item</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi item</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga item</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok item</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" required id="stock" name="stock" value="{{ old('stock') }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pic1" class="form-label">Foto 1 item</label><small> Max: 2MB</small>
                    <input type="file" class="form-control @error('pic1') is-invalid @enderror" required id="pic1" name="pic1" value="{{ old('pic1') }}">
                    @error('pic1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pic2" class="form-label">Foto 2 item</label><small> Max: 2MB</small>
                    <input type="file" class="form-control @error('pic2') is-invalid @enderror" required id="pic2" name="pic2" value="{{ old('pic2') }}">
                    @error('pic2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pic3" class="form-label">Foto 3 item</label><small> Max: 2MB</small>
                    <input type="file" class="form-control @error('pic3') is-invalid @enderror" required id="pic3" name="pic3" value="{{ old('pic3') }}">
                    @error('pic3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
        </div>
    </div>
    </div>
</div>
@endsection

  