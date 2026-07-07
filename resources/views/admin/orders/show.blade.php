@extends('layouts.admin_layout')

@section('orders_active', 'active')
@section('title', 'Detail Order')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Order #{{ $order->id }}</h1>
            <p class="text-muted mb-0">Rincian lengkap pesanan pelanggan dan status pengiriman.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Orders</a>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="mb-3">Informasi Pelanggan</h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ $order->customer->name ?? 'Tidak diketahui' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->customer->email ?? 'Tidak diketahui' }}</p>
                    <p class="mb-1"><strong>Dibuat:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="mb-1"><strong>Diperbarui:</strong> {{ $order->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="mb-3">Rincian Pesanan</h5>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Produk:</strong> {{ $order->product->name }}</p>
                        <p class="mb-1"><strong>Harga Satuan:</strong> Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                        <p class="mb-1"><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Status:</strong>
                            <span class="badge bg-{{ $order->status === 'pending' ? 'warning text-dark' : ($order->status === 'completed' ? 'success' : 'secondary') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-yellow">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection