<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan dashboard pelanggan
    public function dashboard()
    {
        return redirect()->route('home');
    }

    // Menampilkan daftar produk yang tersedia
    public function products(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();

        return view('customer.products', compact('products'));
    }

    // Menampilkan detail produk
    public function showProduct($id)
    {
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID atau tampilkan 404
        return view('customer.product-show', compact('product'));
    }

    public function searchByCategory(Request $request)
    {
        $category = $request->input('category'); // Ambil kategori dari request
        $products = Product::when($category, function($query, $category) 
        {
        return $query->where('category', $category);
        })->paginate(10); // Mengambil produk berdasarkan kategori jika tersedia

        return view('customer.products', compact('products', 'category')); // Passing kategori ke view
    }


    // Menambahkan produk ke keranjang
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Logika untuk menambahkan produk ke keranjang
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image_url,
            ];
        }

        // Simpan kembali keranjang ke session
        session()->put('cart', $cart);

        return redirect()->route('customer.cart.view')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Menampilkan keranjang belanja
    public function viewCart()
    {
        $cart = session()->get('cart');
        return view('customer.cart', compact('cart'));
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart');

        // Jika keranjang ada dan produk ada di dalamnya
        if (isset($cart[$id])) {
            // Hapus produk dari keranjang
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('customer.cart.view')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->route('customer.cart.view')->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    // Menampilkan pesanan pelanggan
    public function orders()
    {
        $orders = Order::with('product')->where('customer_id', auth()->id())->paginate(10); // Eager load product dan paginate
        return view('customer.orders', compact('orders'));
    }


    // Menampilkan halaman checkout
    public function checkout()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Mengambil data keranjang dari session
        $cart = session()->get('cart');

        // Memeriksa apakah keranjang kosong
        if (!$cart || empty($cart)) {
            return redirect()->route('customer.cart.view')->with('error', 'Keranjang Anda kosong.');
        }

        // Mengambil informasi tambahan yang mungkin diperlukan untuk checkout
        // Misalnya, alamat pengiriman, metode pembayaran, dll.
        // Anda bisa mendapatkan data ini dari model atau database jika diperlukan
        $address = $user->address; // Misalnya, ambil alamat dari model User
        $paymentMethods = ['Credit Card', 'PayPal', 'Bank Transfer']; // Contoh metode pembayaran

        // Mengembalikan tampilan checkout dengan data yang diperlukan
        return view('customer.checkout.index', compact('cart', 'address', 'paymentMethods'));
    }

    // Memproses checkout
    public function processCheckout(Request $request)
    {
        // Validasi data checkout
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,cash_on_delivery',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();
        $cart = session()->get('cart');

        if (!$cart || empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Keranjang Anda kosong.');
        }

        // Buat pesanan untuk setiap item di keranjang
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                // Ensure there's enough stock
                if ($product->stock >= $item['quantity']) {
                    $order = new Order();
                    $order->customer_id = $user->id;  // Set ID pengguna ke ID pengguna yang terautentikasi
                    $order->product_id = $id;
                    $order->quantity = $item['quantity'];
                    $order->total_price = $item['price'] * $item['quantity']; // Total harga
                    $order->status = 'pending'; // Status pesanan
                    $order->address = $validatedData['address']; // Simpan alamat pengiriman
                    $order->payment_method = $validatedData['payment_method']; // Simpan metode pembayaran
                    $order->save();

                    // Kurangi stok produk
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }
        }

        // Hapus keranjang setelah pesanan dibuat
        session()->forget('cart');

        return redirect()->route('customer.checkout.success')->with('success', 'Pesanan berhasil diproses!');
    }

    // Menampilkan halaman sukses setelah checkout
    public function checkoutSuccess()
    {
        return view('customer.checkout.success');
    }


    public function search(Request $request)
    {
        $category = $request->input('category');
        $products = Product::where('category', $category)->paginate(10); // Mengambil produk berdasarkan kategori

        return view('Category', compact('products', 'category'));
    }


    // Halaman profil
    public function profile()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Jika tidak ada pengguna yang terautentikasi, redirect ke halaman login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk melihat profil.');
        }

        return view('customer.profile', compact('user'));
    }

    // Halaman edit profil
    public function editProfile()
    {
        $user = Auth::user();
        return view('customer.edit-profile', compact('user'));
    }

    // Update profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi data profil
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture && file_exists(public_path('storage/profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('storage/profile_pictures/' . $user->profile_picture));
            }

            // Store new picture
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_pictures', $filename, 'public');
            $request->merge(['profile_picture' => $filename]);
        }

        // Update data pengguna
        $user->update($request->all());

        return redirect()->route('customer.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}