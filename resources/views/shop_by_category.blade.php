@extends('layouts.home_layout')

@section('title', 'Shop by Category')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-2">Shop by Category</h2>
            <p class="text-muted">Temukan produk terbaik berdasarkan kategori favorit Anda.</p>
        </div>
    </div>

    @if(isset($categories) && $categories->count() > 0)
        @foreach($categories as $category)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 text-capitalize">{{ $category }}</h4>
                        <a href="{{ route('search', ['category' => $category]) }}" class="btn btn-sm btn-yellow">Lihat Semua</a>
                    </div>

                    @if(isset($productsByCategory[$category]) && $productsByCategory[$category]->count() > 0)
                        <div class="row g-4">
                            @foreach($productsByCategory[$category] as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/250' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title">{{ $product->name }}</h6>
                                            <p class="text-muted small mb-2">{{ Str::limit($product->description, 70) }}</p>
                                            <div class="mt-auto">
                                                <p class="fw-bold mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                <a href="{{ route('customer.product.show', $product->id) }}" class="btn btn-sm btn-outline-dark w-100">Lihat Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">Belum ada produk di kategori {{ ucfirst($category) }}.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">Belum ada kategori produk.</div>
    @endif
</div>
@endsection