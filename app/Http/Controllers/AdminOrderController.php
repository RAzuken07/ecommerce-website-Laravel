<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $orders = Order::with('customer', 'product')->paginate(10); // Mengambil data pesanan dengan relasi
        $orderCount = Order::count();
        $totalSales = Order::sum('total_price');

        // Menghitung penjualan bulanan
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total_sales')
                            ->groupBy('month')
                            ->get();

        $labels = [];
        $salesData = [];

        foreach ($monthlySales as $sale) {
            $labels[] = Carbon::create()->month($sale->month)->format('F');
            $salesData[] = $sale->total_sales;
        }

        return view('admin.orders.index', compact('orders', 'orderCount', 'totalSales', 'labels', 'salesData'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::with('customer', 'product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Membuat pesanan baru
    public function createOrder(Request $request)
    {
        // Validasi data pesanan
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'courier' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric',
        ]);

        // Temukan produk
        $product = Product::findOrFail($validated['product_id']);

        // Periksa apakah stok cukup
        if ($product->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk produk ini.');
        }

        // Buat pesanan baru
        $order = new Order();
        $order->customer_id = auth()->id(); // ID pelanggan yang sedang login
        $order->product_id = $product->id;
        $order->quantity = $validated['quantity'];
        $order->total_price = $product->price * $validated['quantity'] + $validated['shipping_cost'];
        $order->status = 'pending'; // Atur status awal
        $order->courier = $validated['courier'];
        $order->shipping_cost = $validated['shipping_cost'];
        $order->tracking_number = null; // Atur jika ada
        $order->staff_id = null; // Atur jika ada
        $order->save();

        // Kurangi stok produk
        $product->stock -= $validated['quantity'];
        $product->save(); // Simpan perubahan stok

        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menghapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}