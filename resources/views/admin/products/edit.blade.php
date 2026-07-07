@extends('layouts.admin_layout')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Edit Produk</h1>
            <p class="text-muted mb-0">Perbarui informasi produk dan stok dengan mudah.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Produk</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label fw-semibold">Harga</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="makanan" {{ old('category', $product->category) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="kandang" {{ old('category', $product->category) == 'kandang' ? 'selected' : '' }}>Kandang</option>
                                <option value="sampo" {{ old('category', $product->category) == 'sampo' ? 'selected' : '' }}>Sampo</option>
                                <option value="obat" {{ old('category', $product->category) == 'obat' ? 'selected' : '' }}>Obat</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="mb-4 h-100 d-flex flex-column">
                            <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                            <textarea class="form-control @error('description') is-invalid @enderror flex-grow-1" id="description" name="description" rows="12" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap mt-3">
                    <button type="submit" class="btn btn-yellow">Perbarui Produk</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description');
    }
</script>
@endsection