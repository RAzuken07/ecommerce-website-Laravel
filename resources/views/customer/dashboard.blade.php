@extends('layouts.customer_layout')

@section('title', 'Dashboard Pelanggan')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0 fw-bold">Dashboard</h2>
            <p class="text-muted">Selamat datang, {{ auth()->user()?->name ?? 'Pelanggan' }}!</p>
        </div>
    </div>

    <div class="row mb-5">
        <!-- Kotak Jumlah Pesanan -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-yellow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Jumlah Pesanan</h6>
                        <h3 class="mb-0 fw-bold">{{ $orderCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak Total Pengeluaran -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-yellow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Pengeluaran</h6>
                        <h3 class="mb-0 fw-bold">Rp{{ number_format($totalSpent, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kotak Produk Tersedia -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-yellow rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px;">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Produk Tersedia</h6>
                        <h3 class="mb-0 fw-bold">{{ count($products) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="fw-bold mb-4">Semua Produk</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-brand">{{ $product->category_name }}</div>
                    <a href="{{ route('customer.product.show', $product->id) }}" class="product-title">{{ Str::limit($product->name, 40) }}</a>
                    <div class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    
                    @if(auth()->check() && auth()->user()->role === 'customer')
                        <form action="{{ route('customer.cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-to-cart-btn"><i class="fas fa-cart-plus me-1"></i> Add to Cart</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection