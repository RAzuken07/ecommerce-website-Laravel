@extends('layouts.staff_layout')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mt-4">
    <div class="page-header mb-4">
        <h1 class="h3 mb-0" style="font-weight: 700;">Daftar Pesanan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="px-4 py-3 text-muted text-uppercase" style="font-size: 12px; font-weight: 600;">No</th>
                            <th class="py-3 text-muted text-uppercase" style="font-size: 12px; font-weight: 600;">ID Pesanan</th>
                            <th class="py-3 text-muted text-uppercase" style="font-size: 12px; font-weight: 600;">Total Harga</th>
                            <th class="py-3 text-muted text-uppercase" style="font-size: 12px; font-weight: 600;">Status</th>
                            <th class="px-4 py-3 text-muted text-uppercase text-end" style="font-size: 12px; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                        <tr>
                            <td class="px-4">{{ $index + 1 }}</td>
                            <td><span class="fw-bold">#{{ $order->id }}</span></td>
                            <td class="fw-bold text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-danger">Canceled</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                <form action="{{ route('staff.orders.update-status', $order->id) }}" method="POST" class="d-inline-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto me-2" style="border-color: #f8c144;">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-yellow"><i class="fas fa-save"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fs-1 mb-3"></i>
                                <p>Belum ada pesanan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection