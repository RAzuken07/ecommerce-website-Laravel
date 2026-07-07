<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // Menampilkan daftar produk
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Product::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    // Menampilkan form untuk menambah produk
    public function create()
    {
        $categories = ['makanan', 'kandang', 'sampo', 'obat']; // Daftar kategori
        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric',
            'description'   => 'required',
            'category'      => 'required|in:makanan,kandang,sampo,obat', // Validasi kategori
        ]);

        // Simpan file gambar
        $image = $request->file('image');
        $imagePath = $image->storeAs('public/products', $image->hashName());

        // Simpan data ke database
        Product::create([
            'image'       => $image->hashName(),
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'category'    => $request->category, // Simpan kategori
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID atau tampilkan 404
        return view('admin.products.show', compact('product'));
    }

    // Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        $categories = ['makanan', 'kandang', 'sampo', 'obat']; // Daftar kategori
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Memperbarui data produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric',
            'description'   => 'required',
            'category'      => 'required|in:makanan,kandang,sampo,obat', // Validasi kategori
        ]);

        // Jika ada file baru, ganti file lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::delete('public/products/' . $product->image);

            // Simpan gambar baru
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/products', $image->hashName());

            $product->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category, // Perbarui kategori
            ]);
        } else {
            $product->update($request->only(['name', 'price', 'description', 'category'])); // Perbarui kategori
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        // Hapus gambar dari storage
        Storage::delete('public/products/' . $product->image);

        // Hapus produk dari database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}