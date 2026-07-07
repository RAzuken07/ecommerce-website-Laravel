@extends('layouts.staff_layout')

@section('title', 'Dashboard Staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard Staff</h1>
            <p class="text-muted mb-0">Ringkasan performa operasional dan stok produk Anda.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-secondary btn-sm">Refresh</button>
            <button class="btn btn-yellow btn-sm">Export Report</button>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6>Total Revenue</h6>
                        <h3>Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <div class="stat-icon bg-yellow">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <p class="text-muted mb-0">Total pendapatan dari semua pesanan.</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6>Total Orders</h6>
                        <h3>{{ $orderCount }}</h3>
                    </div>
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <p class="text-muted mb-0">Jumlah pesanan yang telah dibuat pelanggan.</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6>Products</h6>
                        <h3>{{ $productCount }}</h3>
                    </div>
                    <div class="stat-icon bg-success">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
                <p class="text-muted mb-0">Semua produk yang terdaftar di sistem.</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6>Pending Orders</h6>
                        <h3>{{ $pendingOrders }}</h3>
                    </div>
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <p class="text-muted mb-0">Pesanan yang sedang menunggu konfirmasi.</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Revenue Analytics</h5>
                        <small class="text-muted">Lihat performa pendapatan bulanan.</small>
                    </div>
                    <span class="badge bg-success">Updated 2 hours ago</span>
                </div>
                <div class="card-body" style="min-height: 420px;">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Top Categories</h5>
                </div>
                <div class="card-body">
                    @if($topCategories->count())
                        <ul class="list-group list-group-flush">
                            @foreach($topCategories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div>
                                        <div class="fw-bold text-capitalize">{{ $category->category }}</div>
                                        <small class="text-muted">Produk tersedia</small>
                                    </div>
                                    <span class="badge bg-yellow rounded-pill">{{ $category->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Belum ada kategori produk.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myBarChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [12000, 15000, 18000, 14000, 19000, 22000],
                    borderColor: '#f8c144',
                    backgroundColor: 'rgba(248,193,68,0.15)',
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: '#f8c144',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    }
                }
            }
        });
    }
</script>
@endsection
