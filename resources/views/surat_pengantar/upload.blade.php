<!-- resources/views/surat_pengantar/upload.blade.php -->

@extends('layouts.app')
@section('title')
@section('content')
<div class="container">
    <h2>Upload Surat Pengantar Pembimbing</h2>
    <form action="{{ route('surat_pengantar.store', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="file_surat_pengantar" class="form-label">Pilih File Surat Pengantar (PDF)</label>
            <input type="file" class="form-control" id="file_surat_pengantar" name="file_surat_pengantar" required>
            @error('file_surat_pengantar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
