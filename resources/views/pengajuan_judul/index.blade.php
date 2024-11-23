@extends('layouts.app')
@section('title','Pengajuan Judul')
@section('content')
<!-- resources/views/pengajuan_judul/index.blade.php -->
<h1>Daftar Pengajuan Judul</h1>
@foreach ($pengajuan as $item)
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <p class="form-control">{{ $item->judul }}</p>

        <label for="abstrak" class="form-label">Abstrak</label>
        <textarea class="form-control" readonly>{{ $item->abstrak }}</textarea>

        <label for="status" class="form-label">Status Pengajuan</label>
        <p class="form-control">{{ ucfirst($item->status) }}</p>

        @if ($item->status == 'ditolak')
            <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
            <p class="form-control">{{ $item->alasan_penolakan }}</p>
        @endif

        {{-- Form upload bukti pembayaran jika diterima --}}
        @if ($item->status == 'diterima' && !$item->bukti_pembayaran)
            <form action="{{ route('pengajuan_judul.uploadBukti', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                <button class="btn btn-success" type="submit">Upload</button>
            </form>
        @endif

        {{-- Link untuk surat pengantar jika sudah diupload --}}
        <label for="surat_pengantar" class="form-label">Surat Pengantar</label>
        <p>
            @if($item->suratPengantar)
                <a class="btn btn-primary" href="{{ asset('storage/' . $item->suratPengantar->file_surat_pengantar) }}" target="_blank">Lihat Surat Pengantar</a>
            @else
                <span class="text-warning">Belum diupload</span>
            @endif
        </p>
    </div>
@endforeach
@endsection
