@extends('layouts.admin_layout')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Detail Produk</h1>
            <p class="text-muted mb-0">Informasi lengkap produk untuk review dan manajemen.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Produk</a>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-center align-items-center p-4" style="background:#f8f9fa; border-radius:16px;">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 320px;">
                    @else
                        <div class="text-center text-muted">No Image Available</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="h4">{{ $product->name }}</h2>
                            <p class="text-muted mb-1">{{ ucfirst($product->category ?? 'Tanpa Kategori') }}</p>
                        </div>
                        <span class="badge bg-yellow text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-1">Deskripsi Produk</p>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-light">
                                <p class="text-muted small mb-1">Stok</p>
                                <h5>{{ $product->stock }}</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-light">
                                <p class="text-muted small mb-1">Diperbarui</p>
                                <h5>{{ $product->updated_at->format('d M Y') }}</h5>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-yellow me-2">Edit Produk</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection