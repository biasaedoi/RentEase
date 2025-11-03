@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm mb-3"
                    alt="{{ $product->name }}">
            @else
                <div class="bg-light text-center py-5 rounded">Tidak ada gambar</div>
            @endif
        </div>

        <div class="col-md-7">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <h4 class="text-success mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}/hari</h4>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            <h5 class="mt-4">Ajukan Sewa</h5>

            @if (!$product->is_available)
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Produk ini sedang dipinjam dan belum tersedia.
                </div>
                <button class="btn btn-secondary w-100" disabled>
                    <i class="bi bi-lock"></i> Tidak Tersedia untuk Disewa
                </button>

            @elseif (auth()->user() && auth()->user()->role === 'admin')
                <div class="alert alert-info">
                    <i class="bi bi-person-gear"></i> Anda login sebagai admin. Penyewaan hanya untuk pelanggan.
                </div>

            @else
                <form action="{{ route('rentals.store', $product->id) }}" method="POST" class="border rounded p-3 shadow-sm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-cart-check"></i> Ajukan Sewa
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection