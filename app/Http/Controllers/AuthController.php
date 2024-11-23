<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request) {
        $credentials = $request->validate([
            'nim' => 'required|digits:10',
            'password' => 'required|min:5',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'nim' => 'NIM atau password salah',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|digits:10|unique:users,nim',
            'name' => 'required|string|max:255',
            'password' => 'required|min:5|max:10',
            'role' => 'required|in:mahasiswa,prodi,staff_prodi',
        ]);
    
        try {
            // Membuat pengguna baru dengan hashing password
            $user = User::create([
                'nim' => $request->nim,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        } catch (\Exception $e) {
            // Tambahkan log atau tampilkan error jika penyimpanan gagal
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    
        // Debugging untuk memastikan data tersimpan
        if ($user) {
            // Jika berhasil, lakukan login otomatis
            Auth::attempt($request->only('nim', 'password'));
            // Pesan sukses
            $message = "Registrasi berhasil! Selamat datang kembali.";
            return redirect()->intended('/dashboard')->with('success', $message);
        } else {
            // Jika gagal, berikan feedback ke user
            return back()->withErrors(['error' => 'Gagal membuat pengguna baru. Silakan coba lagi.']);
        }
    }
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}
