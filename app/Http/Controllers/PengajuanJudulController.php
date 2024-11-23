<?php

namespace App\Http\Controllers;

use App\Models\PengajuanJudul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPengantar;

class PengajuanJudulController extends Controller
{
    public function create()
    {
        // Halaman form pengajuan judul
        return view('pengajuan_judul.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'abstrak' => 'required|string|max:1500', // Maksimal 150 kata
        ]);

        // Menyimpan pengajuan judul ke database
        PengajuanJudul::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'abstrak' => $request->abstrak,
        ]);

        return redirect()->route('pengajuan_judul.index')->with('success', 'Pengajuan judul berhasil disimpan.');
    }

    public function index()
    {
        // Ambil data pengajuan judul milik mahasiswa yang sedang login
        $pengajuan = PengajuanJudul::with('suratPengantar')->where('user_id', auth()->id())->get();
        return view('pengajuan_judul.index', compact('pengajuan'));
    }
    
    

    public function uploadBukti(Request $request, $id)
    {
        // Cari pengajuan berdasarkan ID
        $pengajuan = PengajuanJudul::findOrFail($id);

        // Pastikan hanya mahasiswa yang memiliki judul yang bisa mengupload bukti
        if ($pengajuan->user_id != Auth::id() || $pengajuan->status != 'diterima') {
            return redirect()->back()->withErrors('Tidak dapat mengupload bukti untuk judul ini.');
        }

        // Validasi file
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Upload file
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update database
        $pengajuan->update(['bukti_pembayaran' => $path]);

        return redirect()->route('pengajuan_judul.index')->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    // Method untuk menampilkan daftar pengajuan judul untuk prodi
    public function seleksiIndex()
    {
        // Menampilkan semua pengajuan judul
        $pengajuan = PengajuanJudul::all();
        return view('pengajuan_judul.seleksi_index', compact('pengajuan'));
    }

    // Method untuk menampilkan form seleksi judul
    public function seleksiForm($id)
    {
        // Ambil data pengajuan berdasarkan ID
        $pengajuan = PengajuanJudul::findOrFail($id);
        return view('pengajuan_judul.seleksi_form', compact('pengajuan'));
    }

    // Method untuk menyimpan hasil seleksi judul
    public function seleksiUpdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'alasan_penolakan' => 'nullable|string|max:255|required_if:status,ditolak', // Menambahkan nullable dan required_if
        ]);

        // Update status dan alasan penolakan
        $pengajuan = PengajuanJudul::findOrFail($id);
        $pengajuan->status = $request->status;

        // Hapus alasan penolakan jika statusnya diterima
        if ($request->status === 'diterima') {
            $pengajuan->alasan_penolakan = null;
        } else {
            // Simpan alasan penolakan jika statusnya ditolak
            $pengajuan->alasan_penolakan = $request->alasan_penolakan;
        }

        // Simpan perubahan
        if ($pengajuan->save()) {
            return redirect()->route('pengajuan_judul.seleksiIndex')->with('success', 'Hasil seleksi berhasil disimpan.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan hasil seleksi.']);
        }
    }
    public function showMahasiswaPengajuan($id)
    {
        $pengajuan = PengajuanJudul::with('suratPengantar')->where('id', $id)->firstOrFail();
        return view('mahasiswa.pengajuan_detail', compact('pengajuan'));
    }
    
}
