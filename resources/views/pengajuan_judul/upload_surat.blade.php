@extends('layouts.app')
@section('title','Surat')

@section('content')
    
@endsection
@endsection
<!-- resources/views/pengajuan_judul/upload_surat.blade.php -->
<h1>Upload Surat Pengantar Pembimbing</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('pengajuan_judul.uploadSurat', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="surat_pengantar">Surat Pengantar (PDF, max 2MB):</label>
        <input type="file" name="surat_pengantar" id="surat_pengantar" required>
        @error('surat_pengantar')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Upload Surat Pengantar</button>
</form>
@endsection