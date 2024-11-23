@extends('layouts.app')
@section('title','Halaman Seleksi')
@section('content')

<h1>Form Seleksi Judul Skripsi</h1>
<div class="mb-3">
    <label for="judul" class="font-weight-bold">Judul Skripsi</label>
    <p class="form-control">{{ $pengajuan->judul }}</p>
    <label for="abstrak" class="font-weight-bold">Abstrak</label>
    <textarea class="form-control">{{ $pengajuan->abstrak }}</textarea>
</div>
<form action="{{ route('pengajuan_judul.seleksiUpdate', $pengajuan->id) }}" method="POST">
    @csrf
    @method('POST') <!-- atau PUT jika route menggunakan metode PUT -->
    
    <div class="mb-3">
        <label class="font-weight-bold" for="status">Status:</label>
        <select class="form-control" name="status" id="status" required>
            <option value="diterima" {{ $pengajuan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>
    
    <div class="mb-3" id="alasan_penolakan_div" style="display: none;">
        <label class="font-weight-bold" for="alasan_penolakan">Alasan Penolakan:</label>
        <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan">{{ $pengajuan->alasan_penolakan }}</textarea>
    </div>
    
    <button class="btn btn-success" type="submit">Simpan Hasil Seleksi</button>
</form>

<script>
    document.getElementById('status').addEventListener('change', function () {
        if (this.value === 'ditolak') {
            document.getElementById('alasan_penolakan_div').style.display = 'block';
        } else {
            document.getElementById('alasan_penolakan_div').style.display = 'none';
        }
    });

    if (document.getElementById('status').value === 'ditolak') {
        document.getElementById('alasan_penolakan_div').style.display = 'block';
    }
</script>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
