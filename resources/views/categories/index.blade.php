@extends('layouts.admin_layout')

@section('categories_active', 'active')
@section('title', 'Daftar Kategori')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Daftar Kategori</h1>
            <p class="text-muted mb-0">Atur kategori produk untuk navigasi dan filter toko.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-yellow btn-sm">Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-muted">No</th>
                            <th class="text-muted">Nama</th>
                            <th class="text-muted">Deskripsi</th>
                            <th class="text-muted">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 60, '...') }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
