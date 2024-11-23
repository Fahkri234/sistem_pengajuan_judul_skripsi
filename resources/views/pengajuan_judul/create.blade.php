@extends('layouts.app')

@section('title','tambah')
@section('content')
<h2> Ajukan Judul proposal Skripsi</h2>
<!-- resources/views/pengajuan_judul/create.blade.php -->
<form action="{{ route('pengajuan_judul.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Judul Skripsi:</label>
        <input type="text" class="form-control" id="judul" name="judul" required>
    </div>
    <div class="mb-3">
        <label for="abstrak" class="form-label">Abstrak:</label>
        <textarea id="abstrak" class="form-control" name="abstrak" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Ajukan Judul</button>
</form>
@endsection