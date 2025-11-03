@extends('layouts.app')

@section('content')
    <h2>Edit Produk</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label><br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="120" class="rounded mb-2"><br>
            @endif
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection