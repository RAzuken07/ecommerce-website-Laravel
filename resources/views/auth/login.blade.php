@extends('layouts.auth_layout')

@section('title', 'Login')

@section('header_text')

    <p class="mb-0 mt-2 text-dark fw-medium">Welcome back! Please login to your account.</p>
@endsection

@section('content')
    <div class="mb-3">
  <button type="button" 
          class="btn btn-teal btn-sm d-flex align-items-center gap-2 shadow-sm rounded-pill px-3 py-2" 
          onclick="window.history.back();">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Kembali</span>
  </button>
    </div>
    @if(session('error'))
        <div class="alert alert-danger mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autofocus>
        </div>
        <div>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-yellow mt-2">Login</button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Register sekarang</a>
    </div>
@endsection