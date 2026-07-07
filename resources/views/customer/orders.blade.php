@extends('layouts.customer_layout')

@section('title', 'Pesanan Anda')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-2">Pesanan Anda</h2>
        <p class="text-muted">Kelola dan pantau pesanan Anda</p>
    </div>

    @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="card-title mb-2">Pesanan #{{ $order->id }}</h6>
                                    <p class="mb-1"><strong>Produk:</strong> {{ $order->product->name }}</p>
                                    <p class="mb-1"><strong>Jumlah:</strong> {{ $order->quantity }} unit</p>
                                    <p class="mb-1"><strong>Alamat:</strong> {{ $order->address }}</p>
                                    <p class="mb-0"><strong>Metode Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="mb-2">
                                        <p class="text-muted mb-1">Total Harga</p>
                                        <h5 class="text-yellow">Rp{{ number_format($order->total_price, 0, ',', '.') }}</h5>
                                    </div>
                                    @if($order->status === 'pending')
                                        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                                    @elseif($order->status === 'processing')
                                        <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-clipboard-list fa-3x mb-3 text-muted d-block"></i>
            <h5>Belum ada pesanan</h5>
            <p class="text-muted">Anda belum melakukan pesanan apapun. Mulai berbelanja sekarang!</p>
            <a href="{{ route('products') }}" class="btn btn-yellow btn-sm">Belanja Sekarang</a>
        </div>
    @endif
</div>
@endsection