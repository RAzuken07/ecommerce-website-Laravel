<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'total_price',
        'status', // pending, completed, canceled 
        'shipping_cost', 
        'tracking_number', 
        'staff_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id'); // Relasi ke model User
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id'); // Relasi ke model User
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Relasi ke model Product
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class); // Jika ada relasi ke OrderItem
    }
}