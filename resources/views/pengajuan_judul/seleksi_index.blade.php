@extends('layouts.app')
@section('title','Seleksi Judul')
@section('content')
<!-- resources/views/pengajuan_judul/seleksi_index.blade.php -->
<h1 class="text-center" >Daftar Pengajuan Judul Skripsi</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Judul</th>
            <th scope="col">Abstrak</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengajuan as $item)
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->abstrak }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('pengajuan_judul.seleksiForm', $item->id) }}">Seleksi</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection