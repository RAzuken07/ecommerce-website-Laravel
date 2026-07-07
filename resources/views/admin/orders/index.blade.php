@extends('layouts.admin_layout')

@section('orders_active', 'active')
@section('title', 'Daftar Orders')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Daftar Orders</h1>
            <p class="text-muted mb-0">Kelola pesanan pelanggan dengan cepat dan lihat ringkasannya.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge bg-yellow text-dark align-self-center">Total Order: {{ $orderCount }}</span>
            <span class="badge bg-secondary align-self-center">Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-muted">Order</th>
                            <th class="text-muted">Produk</th>
                            <th class="text-muted">Pelanggan</th>
                            <th class="text-muted">Jumlah</th>
                            <th class="text-muted">Total</th>
                            <th class="text-muted">Status</th>
                            <th class="text-muted">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning text-dark' : ($order->status === 'completed' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $orders->links() }}</div>
        </div>
    </div>
</div>
@endsection