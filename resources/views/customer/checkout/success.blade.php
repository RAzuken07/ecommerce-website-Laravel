@extends('layouts.customer_layout')

@section('title', 'Checkout Sukses')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 100px; height: 100px; background-color: #d4edda;">
                            <i class="fas fa-check fa-3x text-success"></i>
                        </div>
                    </div>

                    <h2 class="fw-bold mb-2">Pesanan Berhasil Dibuat!</h2>
                    <p class="text-muted mb-4">Terima kasih telah berbelanja dengan kami. Pesanan Anda telah diproses dengan sukses.</p>

                    <div class="alert alert-info mb-4">
                        <p class="mb-0">
                            <strong>Pesanan Anda sedang diproses.</strong><br>
                            <small class="text-muted">Anda akan menerima konfirmasi melalui email dan dapat melacak pesanan di halaman pesanan Anda.</small>
                        </p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('customer.orders') }}" class="btn btn-yellow btn-lg">
                            <i class="fas fa-box me-2"></i>Lihat Pesanan Saya
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection