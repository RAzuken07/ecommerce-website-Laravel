<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data statistik untuk dashboard
        $productCount = Product::count(); // Menghitung jumlah produk
        $orderCount = Order::count(); // Menghitung jumlah pesanan
        $userCount = User::count(); // Menghitung jumlah user

        // Menghitung jumlah total penjualan
        $totalSales = Order::sum('total_price'); // Mengambil total penjualan dari kolom total_price

        // Deklarasikan array kosong untuk labels dan salesData
        $labels = [];
        $salesData = [];

        // Ambil penjualan per bulan, gunakan total_price yang sesuai di query
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total_sales')
                            ->groupBy('month')
                            ->get();

        // Proses hasil query untuk menyiapkan data grafik
        foreach ($monthlySales as $sale) {
            // Menambahkan nama bulan ke labels
            $labels[] = Carbon::create()->month($sale->month)->format('F');
            // Menambahkan total penjualan ke salesData
            $salesData[] = $sale->total_sales;
        }

        // Kirimkan data ke view
        return view('admin.dashboard', compact('productCount', 'orderCount', 'userCount', 'totalSales', 'labels', 'salesData'));
    }

    public function orders()
{
    $orders = Order::with('user', 'product')->paginate(10); // Paginasi 10 data per halaman
    $orderCount = Order::count();
    $totalSales = Order::sum('total_price');

    $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total_sales')
                         ->groupBy('month')
                         ->get();

    $labels = [];
    $salesData = [];

    foreach ($monthlySales as $sale) {
        $labels[] = \Carbon\Carbon::create()->month($sale->month)->format('F');
        $salesData[] = $sale->total_sales;
    }

    return view('admin.orders.index', compact('orders', 'orderCount', 'totalSales', 'labels', 'salesData'));
}
public function users()
{
    // Ambil semua pengguna dengan paginasi
    $users = User::paginate(10); // Paginasi 10 data per halaman

    return view('admin.users.index', compact('users'));
}
}
