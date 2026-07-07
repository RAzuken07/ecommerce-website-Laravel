<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        
        $featuredProducts = Product::where('stock', '>', 0)->take(8)->get();
        $bestSellers = Product::where('stock', '>', 0)->inRandomOrder()->take(8)->get();
        $topSavers = Product::where('stock', '>', 0)->inRandomOrder()->take(4)->get();
        $newArrivals = Product::where('stock', '>', 0)->orderBy('created_at', 'desc')->take(8)->get();

        // Customer-specific data
        $orderCount = 0;
        $totalSpent = 0;
        $customerRecentOrders = collect();

        if (Auth::check() && Auth::user()->role === 'customer') {
            $orderCount = Order::where('customer_id', Auth::id())->count();
            $totalSpent = Order::where('customer_id', Auth::id())->sum('total_price');
            $customerRecentOrders = Order::where('customer_id', Auth::id())->latest()->take(5)->get();
        }

        return view('customer.home', compact('categories', 'featuredProducts', 'bestSellers', 'topSavers', 'newArrivals', 'orderCount', 'totalSpent', 'customerRecentOrders'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $category = $request->input('category');

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $products = $query->where('stock', '>', 0)->paginate(12)->withQueryString();

        // Provide categories for the layout
        $categories = Product::select('category')->distinct()->pluck('category');
        $selectedCategory = $request->input('category');

        return view('product', compact('products', 'categories', 'selectedCategory'));
    }

    public function products(Request $request)
    {
        $q = $request->input('q');
        $category = $request->input('category');

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        $products = $query->where('stock', '>', 0)->paginate(12)->withQueryString();
        $categories = Product::select('category')->distinct()->pluck('category');
        $selectedCategory = $category;

        return view('product', compact('products', 'categories', 'selectedCategory'));
    }

    public function shopByCategory()
    {
        $categories = Product::select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        $productsByCategory = [];

        foreach ($categories as $category) {
            $productsByCategory[$category] = Product::where('category', $category)
                ->where('stock', '>', 0)
                ->take(4)
                ->get();
        }

        return view('shop_by_category', compact('categories', 'productsByCategory'));
    }
}