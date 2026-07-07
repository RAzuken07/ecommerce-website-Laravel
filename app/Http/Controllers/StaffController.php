<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // Menampilkan dashboard staff
    public function dashboard()
    {
        // Menghitung jumlah pesanan, jumlah produk, total pendapatan, dan status pesanan
        $orderCount = Order::count();
        $productCount = Product::count();
        $totalRevenue = Order::sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();

        // Top kategori berdasarkan jumlah produk
        $topCategories = Product::select('category', DB::raw('COUNT(*) AS total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        return view('staff.dashboard', compact('orderCount', 'productCount', 'totalRevenue', 'pendingOrders', 'topCategories'));
    }

    // Menampilkan daftar produk beserta stoknya
    public function products()
    {
        $products = Product::all();  // Ambil semua produk
        return view('staff.products', compact('products'));
    }

    // Mengupdate stok produk
    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        // Update stok produk
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('staff.products')->with('success', 'Stock updated successfully!');
    }

    // Mengelola pesanan
    public function orders()
    {
        $orders = Order::all();
        return view('staff.orders', compact('orders'));
    }

    // Mengupdate status pesanan
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,canceled', // Validasi status pesanan
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('staff.orders')->with('success', 'Status pesanan berhasil diperbarui');
    }
}