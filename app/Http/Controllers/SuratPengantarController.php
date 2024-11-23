<?php

namespace App\Http\Controllers;

use App\Models\PengajuanJudul;
use App\Models\SuratPengantar;
use Illuminate\Http\Request;

class SuratPengantarController extends Controller
{
    public function showUploadSuratForm($id)
    {
        $pengajuan = PengajuanJudul::findOrFail($id);

        // Hanya menampilkan form jika pengajuan diterima dan bukti pembayaran sudah ada
        if ($pengajuan->status !== 'diterima' || !$pengajuan->bukti_pembayaran) {
            return redirect()->back()->withErrors(['error' => 'Pengajuan belum memenuhi syarat untuk upload surat pengantar.']);
        }

        return view('surat_pengantar.upload', compact('pengajuan'));
    }

    // Menyimpan surat pengantar yang diunggah oleh staff prodi
    public function storeSuratPengantar(Request $request, $id)
    {
        $request->validate([
            'file_surat_pengantar' => 'required|file|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        $pengajuan = PengajuanJudul::findOrFail($id);

        // Pastikan status dan bukti pembayaran terpenuhi
        if ($pengajuan->status !== 'diterima' || !$pengajuan->bukti_pembayaran) {
            return redirect()->back()->withErrors(['error' => 'Pengajuan belum memenuhi syarat untuk upload surat pengantar.']);
        }

        // Proses upload file
        if ($request->hasFile('file_surat_pengantar')) {
            $file = $request->file('file_surat_pengantar');
            $path = $file->store('surat_pengantar', 'public');

            // Simpan path file ke tabel surat_pengantars
            SuratPengantar::create([
                'users_id' => $pengajuan->user_id, // Gunakan user_id dari pengajuan
                'file_surat_pengantar' => $path,
            ]);

            return redirect()->route('dashboard')->with('success', 'Surat pengantar berhasil diupload.');
        }

        return back()->withErrors(['error' => 'Gagal upload surat pengantar.']);
    }
    public function showMahasiswaPengajuan($id)
    {
        $pengajuan = PengajuanJudul::with('suratPengantar')->where('id', $id)->firstOrFail();
        return view('mahasiswa.pengajuan_detail', compact('pengajuan'));
    }
    
}
