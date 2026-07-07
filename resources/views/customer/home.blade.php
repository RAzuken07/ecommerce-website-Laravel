@extends('layouts.home_layout')

@section('title', 'ecommers - Home')

@section('content')
<style>
    .hero-section { margin-top: 20px; }
    .hero-banner { 
        background: #f1f5f4; 
        border-radius: 8px; 
        padding: 40px; 
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .hero-banner img {
        position: absolute;
        right: 0;
        bottom: 0;
        height: 100%;
        object-fit: cover;
    }
    .hero-banner-content {
        position: relative;
        z-index: 2;
        max-width: 50%;
    }
    .hero-banner-right {
        background: #f8c144;
        border-radius: 8px;
        padding: 40px;
        height: 100%;
        position: relative;
    }
    .category-box {
        text-align: center;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 8px;
        background: #fff;
        transition: 0.3s;
        text-decoration: none;
        color: #333;
        display: block;
    }
    .category-box:hover {
        border-color: #f8c144;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .category-box img {
        height: 50px;
        margin-bottom: 15px;
    }
    .section-title {
        font-weight: 700;
        font-size: 22px;
        margin-bottom: 25px;
    }
    .product-card {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
        position: relative;
        transition: 0.3s;
        height: 100%;
    }
    .product-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .product-card .badge-sale {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #e63946;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        z-index: 2;
    }
    .product-img-wrap {
        height: 180px;
        text-align: center;
        margin-bottom: 15px;
    }
    .product-img-wrap img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
    .product-brand {
        font-size: 11px;
        color: #888;
        margin-bottom: 5px;
    }
    .product-title {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        text-decoration: none;
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
    .product-price small {
        font-size: 13px;
        color: #888;
        text-decoration: line-through;
        margin-left: 8px;
    }
    .add-to-cart-btn {
        width: 100%;
        background: #f8c144;
        border: none;
        color: #222;
        font-weight: 600;
        padding: 8px;
        border-radius: 4px;
        margin-top: 15px;
        transition: 0.3s;
    }
    .add-to-cart-btn:hover {
        background: #e6af36;
    }
    .rating {
        color: #ffc107;
        font-size: 12px;
        margin-bottom: 10px;
    }
    .progress-bar-stock {
        height: 6px;
        background: #eee;
        border-radius: 3px;
        margin-top: 10px;
        overflow: hidden;
    }
    .progress-bar-stock div {
        height: 100%;
        background: #f8c144;
    }
</style>

<div class="container hero-section">
    <div class="row g-4">
        <!-- Main Carousel -->
        <div class="col-lg-8">
            <div class="hero-banner">
                <div class="hero-banner-content">
                    <h1 class="fw-bold mb-3" style="font-size: 42px; line-height:1.2;">Active Summer With<br>Premium Products</h1>
                    <p class="text-muted mb-4">New arrivals with great quality, essential for summer.</p>
                    <a href="{{ route('products') }}" class="btn btn-dark px-4 py-2">Shop Now</a>
                </div>
                <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="E-Commerce Banner" style="mask-image: linear-gradient(to right, transparent, black 40%); -webkit-mask-image: linear-gradient(to right, transparent, black 40%);">
            </div>
        </div>
        <!-- Right Banner -->
        <div class="col-lg-4">
            <div class="hero-banner-right">
                <h3 class="fw-bold mb-2">20% SALE OFF</h3>
                <p>Synthetic seeds<br>Net 2.0 OZ</p>
                <a href="{{ route('products') }}" class="btn btn-light px-4 mt-3">Shop Now</a>
            </div>
        </div>
    </div>
</div>

@guest
<div class="container mt-4">
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">Login untuk membeli produk</h5>
            <p class="mb-0">Masuk untuk menambahkan produk ke keranjang, melakukan checkout, dan melihat riwayat pesanan Anda.</p>
        </div>
        <div>
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        </div>
    </div>
</div>
@endguest

<div class="container mt-5">
    <!-- Browse by Category -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Browse by Category</h3>
    </div>
    
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
        @if(isset($categories) && count($categories) > 0)
            @foreach($categories as $cat)
                <div class="col">
                    <a href="{{ route('search', ['category' => $cat]) }}" class="category-box">
                        <i class="fas fa-shopping-bag fa-2x mb-3 text-yellow"></i>
                        <h6 class="mb-0">{{ ucfirst($cat) }}</h6>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col"><a href="{{ route('search', ['category' => 'fashion']) }}" class="category-box"><i class="fas fa-tshirt fa-2x mb-3 text-yellow"></i><h6>Fashion</h6></a></div>
            <div class="col"><a href="{{ route('search', ['category' => 'electronics']) }}" class="category-box"><i class="fas fa-laptop fa-2x mb-3 text-yellow"></i><h6>Electronics</h6></a></div>
            <div class="col"><a href="{{ route('search', ['category' => 'furniture']) }}" class="category-box"><i class="fas fa-couch fa-2x mb-3 text-yellow"></i><h6>Furniture</h6></a></div>
            <div class="col"><a href="{{ route('search', ['category' => 'shoes']) }}" class="category-box"><i class="fas fa-shoe-prints fa-2x mb-3 text-yellow"></i><h6>Shoes</h6></a></div>
            <div class="col"><a href="{{ route('search', ['category' => 'gadgets']) }}" class="category-box"><i class="fas fa-mobile-alt fa-2x mb-3 text-yellow"></i><h6>Gadgets</h6></a></div>
            <div class="col"><a href="{{ route('search', ['category' => 'accessories']) }}" class="category-box"><i class="fas fa-headphones fa-2x mb-3 text-yellow"></i><h6>Accessories</h6></a></div>
        @endif
    </div>
</div>

<div class="container mt-5">
    <!-- Top Saver Today -->
    <h3 class="section-title">Top Saver Today <span class="badge bg-danger ms-2" style="font-size:12px; font-weight:normal;">Expires in: 08 : 25 : 37</span></h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach($topSavers as $product)
            <div class="col">
                <div class="product-card">
                    <span class="badge-sale">Save 15%</span>
                    <div class="product-img-wrap">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-brand">{{ $product->category_name }}</div>
                    <a href="{{ route('customer.product.show', $product->id) }}" class="product-title">{{ Str::limit($product->name, 40) }}</a>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> (24)
                    </div>
                    <div class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }} <small>Rp{{ number_format($product->price * 1.15, 0, ',', '.') }}</small></div>
                    <div class="progress-bar-stock">
                        <div style="width: {{ rand(30, 90) }}%"></div>
                    </div>
                    <div class="mt-2 text-muted" style="font-size:11px;">Sold: {{ rand(10, 50) }}/100</div>
                    
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

<div class="container mt-5">
    <!-- Best Seller -->
    <h3 class="section-title">Best Seller</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach($bestSellers as $product)
            <div class="col">
                <div class="product-card border-0 shadow-sm">
                    <div class="product-img-wrap">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-brand">{{ $product->category_name }}</div>
                    <a href="{{ route('customer.product.show', $product->id) }}" class="product-title">{{ Str::limit($product->name, 40) }}</a>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> (12)
                    </div>
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

<div class="container mt-5 mb-5">
    <!-- Just Landing -->
    <h3 class="section-title">Just Landing</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach($newArrivals as $product)
            <div class="col">
                <div class="product-card border-0 shadow-sm">
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

<!-- Customer Sections (embedded on home) -->
<!-- @auth
    @if(auth()->user()->role == 'customer')
        <div id="customer-dashboard" class="container mt-5">
            <h3 class="section-title">Customer Dashboard</h3>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h6 class="text-muted">Jumlah Pesanan</h6>
                        <h3 class="fw-bold">{{ $orderCount ?? 0 }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h6 class="text-muted">Total Pengeluaran</h6>
                        <h3 class="fw-bold">Rp{{ number_format($totalSpent ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h6 class="text-muted">Produk Tersedia</h6>
                        <h3 class="fw-bold">{{ $featuredProducts->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="customer-products" class="container mt-5">
            <h3 class="section-title">Produk untuk Anda</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($featuredProducts as $product)
                    <div class="col">
                        <div class="product-card">
                            <div class="product-img-wrap">
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                            </div>
                            <div class="product-brand">{{ ucfirst($product->category) }}</div>
                            <a href="{{ route('customer.product.show', $product->id) }}" class="product-title">{{ Str::limit($product->name, 40) }}</a>
                            <div class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                            <form action="{{ route('customer.cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-cart-btn"><i class="fas fa-cart-plus me-1"></i> Add to Cart</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="customer-orders" class="container mt-5">
            <h3 class="section-title">Pesanan Terbaru</h3>
            <div class="card shadow-sm p-3">
                @if(isset($customerRecentOrders) && $customerRecentOrders->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($customerRecentOrders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Order #{{ $order->id }}</div>
                                    <div class="text-muted">Status: {{ $order->status }}</div>
                                </div>
                                <div>Rp{{ number_format($order->total_price,0,',','.') }}</div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3 text-end">
                        <a href="{{ route('home') }}#customer-orders" class="btn btn-outline-primary">Lihat Semua Pesanan</a>
                    </div>
                @else
                    <div class="text-center text-muted">Belum ada pesanan.</div>
                @endif
            </div>
        </div>

        <div id="customer-checkout" class="container mt-5 mb-5">
            <h3 class="section-title">Checkout</h3>
            <div class="card shadow-sm p-4">
                <p class="mb-3">Lihat keranjang Anda dan lanjutkan ke checkout.</p>
                <a href="{{ route('customer.cart.view') }}" class="btn btn-yellow me-2">Lihat Keranjang</a>
                <a href="{{ route('customer.checkout.index') }}" class="btn btn-primary">Proses Checkout</a>
            </div>
        </div>
    @endif
@endauth -->

@endsection
