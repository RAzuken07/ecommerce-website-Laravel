<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Jost', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .text-yellow { color: #f8c144 !important; }
        .bg-yellow { background-color: #f8c144 !important; }
        .btn-yellow { background-color: #f8c144; color: #000; font-weight: 600; border: none; }
        .btn-yellow:hover { background-color: #e6af36; color: #000; }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background: #16213e;
            color: #fff;
            padding-top: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-header .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }
        .sidebar-header .logo-text span { color: #f8c144; }

        .sidebar-nav {
            padding: 15px 0;
            flex-grow: 1;
        }
        .sidebar-nav .nav-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.35);
            padding: 10px 25px 5px;
            margin-top: 10px;
        }
        .sidebar-nav a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-nav a i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
            font-size: 16px;
        }
        .sidebar-nav a:hover {
            background: rgba(248,193,68,0.1);
            color: #f8c144;
            border-left-color: #f8c144;
        }
        .sidebar-nav a.active {
            background: rgba(248,193,68,0.15);
            color: #f8c144;
            border-left-color: #f8c144;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: 0.3s;
        }
        .stat-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }
        .stat-card h6 {
            font-size: 13px;
            color: #888;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .stat-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <div class="sidebar-header">
                    <a href="{{ route('staff.dashboard') }}" class="logo-text">
                        <i class="fas fa-shopping-bag text-yellow"></i> E-<span>Commerce</span>
                    </a>
                    <div class="mt-1" style="font-size:12px; color:rgba(255,255,255,0.4);">Staff Panel</div>
                </div>
                <div class="sidebar-nav">
                    <div class="nav-label">Main</div>
                    <a href="{{ route('staff.dashboard') }}" class="@yield('dashboard_active', '')">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>

                    <div class="nav-label">Management</div>
                    <a href="{{ route('staff.orders') }}" class="@yield('orders_active', '')">
                        <i class="fas fa-shopping-bag"></i> Orders
                    </a>
                    <a href="{{ route('staff.products') }}" class="@yield('products_active', '')">
                        <i class="fas fa-box"></i> Produk & Stok
                    </a>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-yellow rounded-circle d-flex align-items-center justify-content-center" style="width:35px;height:35px;">
                        <i class="fas fa-user" style="font-size:14px;"></i>
                    </div>
                    <div class="ms-2">
                        <div style="font-size:13px; font-weight:600;">{{ auth()->user()?->name ?? 'Staff' }}</div>
                        <div style="font-size:11px; color:rgba(255,255,255,0.4);">Staff</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
