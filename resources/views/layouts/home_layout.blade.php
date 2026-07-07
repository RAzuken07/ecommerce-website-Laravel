<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce - Store')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Jost', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .text-yellow {
            color: #f8c144 !important;
        }

        .bg-yellow {
            background-color: #f8c144 !important;
        }
        
        .btn-yellow {
            background-color: #f8c144;
            color: #000;
            font-weight: 600;
            border: none;
        }
        
        .btn-yellow:hover {
            background-color: #e6af36;
            color: #000;
        }

        /* Header */
        .navbar-custom {
            background-color: #fff;
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

        /* Product Card Styles */
        .product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            background: #fff;
            position: relative;
            transition: 0.3s;
            height: 100%;
        }
        .product-card:hover { 
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
        }
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
        .product-brand { 
            font-size: 11px; 
            color: #888; 
            margin-bottom: 5px; 
        }
        .product-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-decoration: none;
            display: block;
        }
        .product-title:hover { 
            color: #f8c144; 
        }
        .product-price { 
            font-size: 18px; 
            font-weight: 700; 
            color: #f8c144; 
        }
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
        .add-to-cart-btn:hover { 
            background: #e6af36; 
        }

        /* Footer */
        .footer {
            background-color: #fff;
            padding: 40px 0;
            margin-top: 40px;
            border-top: 1px solid #e1e1e1;
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
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
                    @auth
                        <a href="{{ auth()->user()?->isCustomer() ? route('home') : route(auth()->user()?->role . '.dashboard') }}" class="icon-box" title="Account">
                            <i class="far fa-user"></i>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="icon-box btn btn-link p-0 m-0" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="icon-box" title="Login">
                            <i class="far fa-user"></i>
                        </a>
                    @endauth

                    <a href="{{ auth()->check() && auth()->user()->isCustomer() ? route('customer.cart.view') : route('login') }}" class="icon-box" style="position: relative;">
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
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="logo-text mb-3"><i class="fas fa-shopping-bag text-yellow"></i> E-<span>Commerce</span></h4>
                    <p class="text-muted">We provide everything you need at the best prices.</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#" class="text-muted text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Contact Us</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">Customer Service</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#" class="text-muted text-decoration-none">Shipping & Returns</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <!-- <div class="col-md-3">
                    <h5 class="mb-3">Newsletter</h5>
                    <p class="text-muted">Subscribe to our newsletter for latest updates.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-yellow" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4">
            <div class="text-center text-muted">
                &copy; {{ date('Y') }} E-Commerce. All Rights Reserved.
            </div> -->
        </div>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for anchor links to customer sections
        document.addEventListener('DOMContentLoaded', function () {
            function smoothScrollTo(hash) {
                if (!hash) return;
                var el = document.querySelector(hash);
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            // If page loaded with hash, scroll to it
            if (window.location.hash) {
                setTimeout(function () { smoothScrollTo(window.location.hash); }, 100);
            }

            // Intercept clicks on links with hashes
            document.body.addEventListener('click', function (e) {
                var a = e.target.closest('a[href]');
                if (!a) return;
                var href = a.getAttribute('href');
                if (!href) return;
                var hashIndex = href.indexOf('#');
                if (hashIndex === -1) return;

                var hash = href.substring(hashIndex);

                // If link points to an anchor on the home page, handle smoothly
                try {
                    var linkUrl = new URL(href, window.location.origin);
                } catch (err) {
                    return; // not a valid URL
                }

                if (linkUrl.pathname === window.location.pathname && linkUrl.hash) {
                    e.preventDefault();
                    smoothScrollTo(linkUrl.hash);
                    history.replaceState(null, '', linkUrl.hash);
                } else if (linkUrl.pathname === '/' && linkUrl.hash) {
                    // navigate to home first if on another page
                    e.preventDefault();
                    window.location.href = linkUrl.href;
                }
            });
        });
    </script>
</body>

</html>