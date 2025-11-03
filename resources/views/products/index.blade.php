@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📦 Katalog Produk</h2>

    @if(auth()->user() && auth()->user()->is_admin)
        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Tambah Produk
        </a>
    @endif
</div>

@if (auth()->check() && !auth()->user()->is_admin)
    <div class="mb-3">
        <a href="{{ route('rentals.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-clock-history"></i> Lihat Status Sewa Saya
        </a>
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="card-img-top" 
                         alt="{{ $product->name }}" 
                         style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light text-center py-5 text-muted">Tidak ada gambar</div>
                @endif

                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>
                    <h6 class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}/hari</h6>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye"></i> Lihat
                    </a>

                    @if (auth()->user() && auth()->user()->is_admin)
                        <div>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Yakin ingin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted mt-4">Belum ada produk yang tersedia</p>
    @endforelse
</div>
@endsection
