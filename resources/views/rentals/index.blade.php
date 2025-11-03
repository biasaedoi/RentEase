@extends('layouts.app')

@section('content')
    <h2>Daftar Penyewaan Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->product->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>Rp {{ number_format($rental->total_price, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection