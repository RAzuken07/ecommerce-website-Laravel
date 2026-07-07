@extends('layouts.admin_layout')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-1">Laporan Penjualan</h1>
            <p class="text-muted mb-0">Rekap transaksi terbaru dan total penjualan toko.</p>
        </div>
        <span class="badge bg-yellow text-dark align-self-center">Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-muted">Pesanan</th>
                            <th class="text-muted">Pelanggan</th>
                            <th class="text-muted">Total Harga</th>
                            <th class="text-muted">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>#{{ $sale->id }}</td>
                                <td>{{ $sale->customer_name }}</td>
                                <td>Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                                <td>{{ \Carbon::parse($sale->created_at)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection