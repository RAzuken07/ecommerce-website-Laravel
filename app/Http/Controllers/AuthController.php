<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Coba login menggunakan Auth facade
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'customer' || $user->role === 'pelanggan') {
                return redirect()->route('home');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard');
            }
        }

        // Jika login gagal
        return back()->with('error', 'Email atau password salah.');
    }

    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan Anda memiliki view register
    }

    // Memproses pendaftaran
    public function register(Request $request)
    {
        // Validasi data pendaftaran
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'],
        ]);

        // Login pengguna setelah pendaftaran
        Auth::login($user);

        // Redirect ke halaman profil atau halaman lain setelah pendaftaran
        return redirect()->route('customer.profile')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->name);
    }

    // Memproses logout
    public function logout(Request $request)
    {
        if ($request->method() !== 'POST') {
            abort(405); // Method Not Allowed
        }
        Auth::logout(); // Menggunakan Auth facade untuk logout
        return redirect('/login');
    }
}