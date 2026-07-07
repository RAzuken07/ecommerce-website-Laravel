@extends('layouts.admin_layout')

@section('title', 'Buat Produk')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Buat Produk Baru</h1>
            <p class="text-muted mb-0">Tambahkan produk baru ke katalog toko Anda.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Produk</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama produk" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label fw-semibold">Harga</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="Masukkan harga" required>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="kandang" {{ old('category') == 'kandang' ? 'selected' : '' }}>Kandang</option>
                                <option value="sampo" {{ old('category') == 'sampo' ? 'selected' : '' }}>Sampo</option>
                                <option value="obat" {{ old('category') == 'obat' ? 'selected' : '' }}>Obat</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="mb-4 h-100 d-flex flex-column">
                            <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                            <textarea class="form-control @error('description') is-invalid @enderror flex-grow-1" id="description" name="description" rows="12" placeholder="Masukkan deskripsi produk" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap mt-3">
                    <button type="submit" class="btn btn-yellow">Simpan Produk</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset Form</button>
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