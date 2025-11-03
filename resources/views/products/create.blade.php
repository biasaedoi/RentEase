@extends('layouts.app')

@section('content')
<h2>Tambah Produk</h2>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
