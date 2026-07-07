@extends('layouts.customer_layout')

@section('title', $product->name)

@section('content')
<div class="container mt-4">
    <a href="{{ route('products') }}" class="btn btn-sm btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Produk
    </a>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400' }}" alt="{{ $product->name }}" class="img-fluid rounded w-100">
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-7">
            <div class="mb-3">
                <span class="badge bg-secondary mb-2">{{ $product->category_name }}</span>
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
            </div>

            <!-- Price -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Harga</h5>
                    <h3 class="text-yellow mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Description & Stock -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Detail Produk</h5>
                    <p class="mb-3">{{ $product->description }}</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0">
                                <strong>Stok Tersedia:</strong>
                            </p>
                            @if($product->stock > 0)
                                <p class="text-success fw-bold">
                                    <i class="fas fa-check-circle me-2"></i>{{ $product->stock }} unit
                                </p>
                            @else
                                <p class="text-danger fw-bold">
                                    <i class="fas fa-times-circle me-2"></i>Stok Habis
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add to Cart -->
            @if($product->stock > 0)
                @if(auth()->check() && auth()->user()->role === 'customer')
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('customer.cart.add') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Jumlah Pembelian</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Maks: {{ $product->stock }} unit</small>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </div>
                                <button type="submit" class="btn btn-yellow btn-lg w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <div class="alert alert-danger mb-0">
                    <i class="fas fa-exclamation-circle me-2"></i>Produk tidak tersedia saat ini
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endsection