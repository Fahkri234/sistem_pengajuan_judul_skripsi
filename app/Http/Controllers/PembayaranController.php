<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $file = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    
        Pembayaran::create([
            'pengguna_id' => Auth::id(),
            'bukti_pembayaran' => $file,
        ]);
    
        return redirect('dashboard')->with('success', 'Bukti pembayaran berhasil diupload.');
    }
    
}
