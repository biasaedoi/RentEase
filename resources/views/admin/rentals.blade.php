@extends('layouts.app')

@section('content')
    <h2>Kelola Penyewaan</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Penyewa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->product->name }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $rental->status == 'approved' ? 'success' :
                ($rental->status == 'rejected' ? 'danger' :
                    ($rental->status == 'returned' ? 'secondary' : 'warning')) 
                        }}">
                            {{ ucfirst($rental->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('rentals.updateStatus', $rental->id) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select form-select-sm d-inline w-auto">
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                                <option value="returned">Returned</option>
                            </select>
                            <button class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection