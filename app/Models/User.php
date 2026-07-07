<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 
        'address',
        'profile_picture',
        'role', // admin, staff, pelanggan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id'); // Sesuaikan dengan kolom foreign key
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}