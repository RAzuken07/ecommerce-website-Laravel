@extends('layouts.customer_layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
        <div>
            <h2 class="fw-bold mb-2">Semua Produk</h2>
            <p class="text-muted mb-0">Jelajahi koleksi lengkap produk kami dan tambahkan ke keranjang dengan mudah.</p>
        </div>
            <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto align-items-center">
                <form action="{{ route('customer.products') }}" method="GET" class="d-flex w-100 align-items-center">
                    <div class="input-group search-group" style="max-width:420px; width:100%;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm search-input border-start-0" placeholder="Cari produk...">
                    </div>
                    <button type="submit" class="btn btn-teal btn-sm ms-2">Cari</button>
                </form>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Beranda</a>
            </div>
    </div>
    
    @if($products->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            @foreach($products as $product)
                <div class="col">
                    <div class="product-card h-100">
                        <div class="product-img-wrap">
                            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/250' }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-brand">{{ $product->category_name }}</div>
                        <a href="{{ route('customer.product.show', $product->id) }}" class="product-title">{{ Str::limit($product->name, 50) }}</a>
                        <div class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                            <a href="{{ route('customer.product.show', $product->id) }}" class="btn btn-outline-secondary btn-sm w-100">Detail</a>
                            @if(auth()->check() && auth()->user()->role === 'customer')
                                <form action="{{ route('customer.cart.add') }}" method="POST" class="w-100">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-yellow btn-sm w-100">
                                        <i class="fas fa-cart-plus me-1"></i> Keranjang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-inbox fa-3x mb-3 text-muted d-block"></i>
            <h5>Tidak ada produk</h5>
            <p class="text-muted">Maaf, produk tidak tersedia saat ini.</p>
        </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .btn-teal {
        background-color: #14b8a6; /* teal-500 */
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-teal:hover {
        background-color: #0f766e; /* teal-700 */
        transform: translateY(-2px);
    }
    .search-group .input-group-text {
        border-radius: 8px 0 0 8px;
        border-right: 0;
    }
    .search-input {
        border-radius: 0 8px 8px 0;
        box-shadow: none;
    }
</style>
@endsection

@section('styles')
<style>
    .btn-teal {
        background-color: #14b8a6; /* teal-500 */
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-teal:hover {
        background-color: #0f766e; /* teal-700 */
        transform: translateY(-2px);
    }
</style>
@endsection
