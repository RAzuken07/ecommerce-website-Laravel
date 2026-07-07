@extends('layouts.admin_layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Daftar Produk</h1>
            <p class="text-muted mb-0">Kelola produk, lihat detail, dan atur stok dengan cepat.</p>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 w-100 w-lg-auto">
            <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex w-100 w-lg-auto">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari produk...">
                <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">Cari</button>
            </form>
            <a href="{{ route('admin.products.create') }}" class="btn btn-yellow btn-sm">Tambah Produk Baru</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                <small class="text-muted">{{ Str::limit($product->description, 60, '...') }}</small>
                            </div>
                            <span class="badge bg-yellow text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="product-img-wrap mb-3" style="height: 180px; display:grid; place-items:center; background:#f8f9fa; border-radius: 14px; overflow:hidden;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:100%; width:auto;">
                            @else
                                <div class="text-muted">No Image</div>
                            @endif
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-secondary">{{ ucfirst($product->category ?? 'Tanpa Kategori') }}</span>
                                <span class="text-muted">Stok: {{ $product->stock }}</span>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm flex-fill">Lihat</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm flex-fill">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-fill d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Tidak ada produk yang tersedia.</div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4 px-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection