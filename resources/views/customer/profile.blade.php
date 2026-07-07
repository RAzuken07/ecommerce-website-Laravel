@extends('layouts.customer_layout')

@section('title', 'My Profile')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Profile</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Profile Picture -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Profile Picture</h5>
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="rounded-circle mb-3 d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px; background-color: #e9ecef;">
                            <i class="fas fa-user fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div>
                        <p class="text-muted mb-0">{{ $user->name }}</p>
                        <small class="text-muted">{{ $user->email }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Personal Information</h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $user->phone ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $user->address ?? 'Not provided' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('customer.profile.edit') }}" class="btn btn-yellow">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection