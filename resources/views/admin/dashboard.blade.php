@extends('layouts.admin_layout')

@section('dashboard_active', 'active')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid mt-4 px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4 px-4">
        <div>
            <h1 class="h3 mb-2">Dashboard Admin</h1>
            <p class="text-muted mb-0">Ringkasan performa toko dan statistik penting untuk manajemen.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-secondary btn-sm">Refresh</button>
            <button class="btn btn-yellow btn-sm">Export Report</button>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Jumlah Produk</h6>
                        <h3>{{ $productCount }}</h3>
                    </div>
                    <div class="stat-icon bg-yellow">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Jumlah Pesanan</h6>
                        <h3>{{ $orderCount }}</h3>
                    </div>
                    <div class="stat-icon" style="background:#6366f1;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Total Penjualan</h6>
                        <h3>{{ "Rp " . number_format($totalSales, 0, ',', '.') }}</h3>
                    </div>
                    <div class="stat-icon" style="background:#10b981;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Jumlah User</h6>
                        <h3>{{ $userCount }}</h3>
                    </div>
                    <div class="stat-icon" style="background:#f43f5e;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">Grafik Penjualan</h5>
                            <p class="text-muted small mb-0">Performa penjualan bulanan.</p>
                        </div>
                        <span class="badge bg-yellow text-dark align-self-center">Updated</span>
                    </div>
                    <div style="min-height: 360px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="mb-3">Ringkasan Cepat</h5>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-muted">Jumlah Produk</p>
                                    <strong>{{ $productCount }} Produk</strong>
                                </div>
                                <span class="badge bg-yellow text-dark">Total</span>
                            </div>
                        </div>
                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-muted">Total Pesanan</p>
                                    <strong>{{ $orderCount }} Pesanan</strong>
                                </div>
                                <span class="badge bg-primary">Selesai</span>
                            </div>
                        </div>
                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-muted">Total Pengguna</p>
                                    <strong>{{ $userCount }} Pengguna</strong>
                                </div>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    if (ctx) {
        const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(248, 193, 68, 0.32)');
        gradient.addColorStop(1, 'rgba(248, 193, 68, 0.05)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Penjualan',
                    data: @json($salesData),
                    borderColor: '#f8c144',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: '#f8c144',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } }
                }
            }
        });
    }
</script>
@endsection