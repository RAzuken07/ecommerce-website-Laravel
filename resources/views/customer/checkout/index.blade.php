@extends('layouts.customer_layout')

@section('title', 'Checkout')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-2">Checkout</h2>
        <p class="text-muted">Selesaikan pembelian Anda</p>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            <!-- Checkout Form -->
            <div class="col-md-8">
                <form action="{{ route('customer.checkout.process') }}" method="POST">
                    @csrf
                    
                    <!-- Delivery Information -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-map-marker-alt me-2 text-yellow"></i>Informasi Pengiriman
                            </h5>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Pengiriman</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                    id="address" name="address" rows="3" 
                                    placeholder="Masukkan alamat pengiriman lengkap Anda" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-credit-card me-2 text-yellow"></i>Metode Pembayaran
                            </h5>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Pilih Metode Pembayaran</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="cash_on_delivery">Bayar di Tempat</option>
                                </select>
                                @error('payment_method')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-yellow btn-lg w-100">
                        <i class="fas fa-check me-2"></i>Proses Checkout
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4">
                <div class="card shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ringkasan Pesanan</h5>
                        
                        <div class="mb-4">
                            @php
                                $total = 0;
                            @endphp
                            @foreach(session('cart') as $id => $item)
                                @php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                @endphp
                                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                    <div>
                                        <p class="mb-1"><strong>{{ $item['name'] }}</strong></p>
                                        <small class="text-muted">Rp{{ number_format($item['price'], 0, ',', '.') }} x {{ $item['quantity'] }}</small>
                                    </div>
                                    <div class="text-end">
                                        <p class="fw-bold">Rp{{ number_format($itemTotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Pengiriman</span>
                                <strong>Rp0</strong>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3">
                                <span class="fw-bold">Total</span>
                                <h5 class="text-yellow">Rp{{ number_format($total, 0, ',', '.') }}</h5>
                            </div>
                        </div>

                        <hr>
                        <a href="{{ route('customer.cart.view') }}" class="btn btn-sm btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-cart fa-3x mb-3 text-muted d-block"></i>
            <h5>Keranjang Kosong</h5>
            <p class="text-muted">Silakan tambahkan produk sebelum melakukan checkout</p>
            <a href="{{ route('products') }}" class="btn btn-yellow btn-sm">Belanja Sekarang</a>
        </div>
    @endif
</div>
@endsection