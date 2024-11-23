<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanJudul;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data pengajuan dengan status 'diterima'
        $pengajuans = PengajuanJudul::where('status', 'diterima')->get();
        
        return view('dashboard', compact('pengajuans'));
    }
    
    
}

