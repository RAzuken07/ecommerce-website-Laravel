@extends('layouts.customer_layout')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-2">Keranjang Belanja</h2>
        <p class="text-muted">Atur dan tinjau pesanan Anda</p>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                @php
                    $total = 0;
                @endphp
                @foreach(session('cart') as $id => $details)
                    @php
                        $itemTotal = $details['price'] * $details['quantity'];
                        $total += $itemTotal;
                    @endphp
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Product Image -->
                                <div class="col-md-2">
                                    <img src="{{ $details['image'] ?? 'https://via.placeholder.com/100' }}" alt="{{ $details['name'] }}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                
                                <!-- Product Details -->
                                <div class="col-md-5">
                                    <h6 class="mb-2">{{ $details['name'] }}</h6>
                                    <p class="text-muted mb-0">Rp{{ number_format($details['price'], 0, ',', '.') }} per item</p>
                                </div>

                                <!-- Quantity & Total -->
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <small class="text-muted">Jumlah</small>
                                        <p class="fw-bold mb-0">{{ $details['quantity'] }} item</p>
                                        <small class="text-muted">Rp{{ number_format($itemTotal, 0, ',', '.') }}</small>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <div class="col-md-2 text-end">
                                    <form action="{{ route('customer.cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="col-md-4">
                <div class="card shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ringkasan Keranjang</h5>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Biaya Pengiriman</span>
                                <strong>Rp0</strong>
                            </div>
                        </div>

                        <div class="border-top pt-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <h5 class="text-yellow mb-0">Rp{{ number_format($total, 0, ',', '.') }}</h5>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('customer.checkout.index') }}" class="btn btn-yellow">
                                <i class="fas fa-credit-card me-2"></i>Lanjut ke Checkout
                            </a>
                            <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-shopping-bag me-2"></i>Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-cart fa-3x mb-3 text-muted d-block"></i>
            <h5>Keranjang Anda Kosong</h5>
            <p class="text-muted">Belum ada produk di keranjang. Mari mulai berbelanja!</p>
            <a href="{{ route('products') }}" class="btn btn-yellow btn-sm">
                <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection