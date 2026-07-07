@extends('layouts.staff_layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h3 mb-2">Daftar Produk</h1>
            <p class="text-muted mb-0">Kelola stok dan detail produk dengan cepat dari panel ini.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge bg-secondary align-self-center">Total Produk: {{ $products->count() }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                <p class="text-muted small mb-0">{{ $product->category ?? 'Kategori tidak tersedia' }}</p>
                            </div>
                            <span class="badge bg-yellow text-dark">Stok {{ $product->stock }}</span>
                        </div>

                        <div class="product-img-wrap mb-3" style="height: 180px; display:grid; place-items:center; overflow:hidden; border-radius: 14px; background:#f8f9fa;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width:100%; max-height:100%; object-fit:cover;">
                            @else
                                <div class="text-muted">No Image</div>
                            @endif
                        </div>

                        <p class="text-muted small mb-3">{{ Str::limit($product->description, 90, '...') }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <div class="text-muted small">Harga</div>
                                    <div class="fw-bold">Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateStockModal{{ $product->id }}">
                                    Update Stok
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="updateStockModal{{ $product->id }}" tabindex="-1" aria-labelledby="updateStockModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('staff.products.update-stock', $product->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStockModalLabel{{ $product->id }}">Update Stok Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="stock{{ $product->id }}" class="form-label">Jumlah Stok Baru</label>
                                        <input type="number" id="stock{{ $product->id }}" name="stock" class="form-control" value="{{ $product->stock }}" min="0" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection