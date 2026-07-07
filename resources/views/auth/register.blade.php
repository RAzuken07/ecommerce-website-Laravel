@extends('layouts.auth_layout')

@section('title', 'Register')

@section('header_text')
    <p class="mb-0 mt-2 text-dark fw-medium">Join us today! Create your new account.</p>
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

    <form method="POST" action="{{ route('register.process') }}">
        @csrf
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
            @error('name')
                <div class="invalid-feedback mb-3" style="margin-top:-15px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
            @error('email')
                <div class="invalid-feedback mb-3" style="margin-top:-15px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your delivery address">
        </div>

        <div>
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Create a password" required>
            @error('password')
                <div class="invalid-feedback mb-3" style="margin-top:-15px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
        </div>
        
        <button type="submit" class="btn btn-yellow mt-2">Create Account</button>
    </form>
    
    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
@endsection