<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Panel')</title>

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

        /* Product Card Styles (Farmart Theme) */
        .product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            background: #fff;
            position: relative;
            transition: 0.3s;
            height: 100%;
        }
        .product-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .product-img-wrap {
            height: 180px;
            text-align: center;
            margin-bottom: 15px;
        }
        .product-img-wrap img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        .product-brand { font-size: 11px; color: #888; margin-bottom: 5px; }
        .product-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-decoration: none;
            display: block;
        }
        .product-title:hover { color: #f8c144; }
        .product-price { font-size: 18px; font-weight: 700; color: #f8c144; }
        .add-to-cart-btn {
            width: 100%;
            background: #f8c144;
            border: none;
            color: #222;
            font-weight: 600;
            padding: 8px;
            border-radius: 4px;
            margin-top: 15px;
            transition: 0.3s;
        }
        .add-to-cart-btn:hover { background: #e6af36; }

        /* Top Nav */
        .navbar-custom {
            background: #fff;
            border-bottom: 3px solid #f8c144;
            padding: 15px 0;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #222;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-text span {
            color: #f8c144;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: #f8c144 !important;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-box {
            position: relative;
            color: #333;
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .icon-box:hover {
            color: #f8c144;
        }

        .badge-cart {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: #f8c144;
            color: #000;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            padding: 30px 0;
            min-height: calc(100vh - 180px);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background-color: #fff;
            padding: 30px 0;
            margin-top: 40px;
            border-top: 1px solid #e1e1e1;
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand logo-text">
                <i class="fas fa-lock"></i> E-<span>Commerce</span>
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.orders') }}">
                            <i class="fas fa-receipt"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.checkout.index') }}">
                            <i class="fas fa-cash-register"></i> Checkout
                        </a>
                    </li>
                </ul>

                <!-- Icons (User & Cart) -->
                <div class="header-icons ms-4">
                    <a href="{{ route('customer.profile') }}" class="icon-box" title="Account">
                        <i class="far fa-user"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="icon-box btn btn-link p-0 m-0" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>

                    <a href="{{ route('customer.cart.view') }}" class="icon-box" style="position: relative;">
                        <i class="fas fa-shopping-cart"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge-cart">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <!-- <footer class="footer">
        <div class="container text-center text-muted">
            &copy; {{ date('Y') }} E-Commerce. All Rights Reserved.
        </div>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>

</html>