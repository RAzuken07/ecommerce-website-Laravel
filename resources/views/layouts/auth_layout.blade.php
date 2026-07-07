<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') - E-Commerce</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Jost', sans-serif;
            background-color: #f1f5f4;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .auth-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .auth-header {
            background: #f8c144;
            padding: 30px 20px;
            text-align: center;
        }
        .auth-header .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #222;
            text-decoration: none;
        }
        .auth-header .logo-text i {
            color: #fff;
        }
        .auth-header span {
            color: #fff;
        }
        .auth-body {
            padding: 40px 30px;
        }
        .form-control {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .form-control:focus {
            border-color: #f8c144;
            box-shadow: 0 0 0 0.25rem rgba(248, 193, 68, 0.25);
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        .btn-yellow {
            background-color: #f8c144;
            color: #000;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            border: none;
            width: 100%;
        }
        .btn-yellow:hover {
            background-color: #e6af36;
            color: #000;
        }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .auth-footer a {
            color: #222;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover {
            color: #f8c144;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <a href="{{ route('home') }}" class="logo-text">
                <i class="fas fa-shopping-bag"></i> E-<span>Commerce</span>
            </a>
            @yield('header_text')
        </div>
        <div class="auth-body">
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>