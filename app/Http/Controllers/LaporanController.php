<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanJudul;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function rekapitulasi()
    {
        // Hitung jumlah judul yang diterima
        $jumlahDiterima = PengajuanJudul::where('status', 'diterima')->count();
    
        // Hitung jumlah judul yang diterima dan sudah melakukan pembayaran
        $jumlahDenganPembayaran = PengajuanJudul::where('status', 'diterima')
                                ->whereNotNull('bukti_pembayaran')
                                ->count();
    
        return view('laporan.rekapitulasi', compact('jumlahDiterima', 'jumlahDenganPembayaran'));
    }
    
    
}
