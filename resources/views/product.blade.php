@extends('layouts.home_layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
    <div>
        <h2 class="fw-bold mb-2">
            {{ !empty($selectedCategory) ? 'Produk ' . ucfirst($selectedCategory) : 'Semua Produk' }}
        </h2>
        <p class="text-muted mb-0">
            {{ !empty($selectedCategory) ? 'Menampilkan produk yang masuk ke kategori ' . ucfirst($selectedCategory) : 'Jelajahi koleksi lengkap produk kami' }}
        </p>
    </div>
</div>

<div class="mb-4">
    <form action="{{ route('products') }}" method="GET" 
          class="d-flex gap-2 flex-wrap align-items-center bg-white rounded-pill shadow-sm px-3 py-2">
        
        <div class="input-group input-group-sm flex-grow-1">
            <span class="input-group-text bg-transparent border-0">
                <i class="fa-solid fa-magnifying-glass text-muted"></i>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" 
                   class="form-control border-0" placeholder="Cari produk...">
        </div>

        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <button type="submit" class="btn btn-teal btn-sm rounded-pill px-3">
            <i class="fa-solid fa-search me-1"></i> Cari
        </button>

        @if(request('q'))
            <a href="{{ route('products') }}" 
               class="btn btn-outline-danger btn-sm rounded-pill px-3">
                <i class="fa-solid fa-rotate-left me-1"></i> Reset
            </a>
        @endif
    </form>
</div>


    @if($products->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            @foreach($products as $product)
                <div class="col">
                    <div class="product-card h-100">
                        <div class="product-img-wrap">
                            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/250' }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-brand">{{ $product->category }}</div>
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
                                        <i class="fas fa-cart-plus me-1"></i> Tambah
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
    .product-card {
        border: 1px solid #e8e8e8;
        border-radius: 16px;
        padding: 18px;
        background: #fff;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
    }
    .product-img-wrap {
        height: 220px;
        display: grid;
        place-items: center;
        margin-bottom: 16px;
    }
    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 14px;
    }
    .product-brand {
        font-size: 12px;
        color: #7d7d7d;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 10px;
    }
    .product-title {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        text-decoration: none;
        margin-bottom: 10px;
        display: block;
    }
    .product-title:hover {
        color: #f8c144;
    }
    .product-price {
        font-size: 18px;
        font-weight: 700;
        color: #f8c144;
    }
    .btn-yellow {
        background-color: #f8c144;
        color: #000;
    }
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
