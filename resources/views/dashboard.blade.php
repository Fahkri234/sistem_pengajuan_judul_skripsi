@extends('layouts.app')
@section('title','dashboard')

@section('content')
@if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
@endif
{{-- Untuk memastikan nilai role dan data pengajuan --}}
{{-- Role: {{ auth()->user()->role }} <br>
Pengajuan ID: {{ isset($pengajuan) ? $pengajuan->id : 'Data tidak ada' }} --}}

<h1 class="text-center" >Selamat Datang {{ auth()->user()->name }}</h1>
@if(auth()->user()->role == 'mahasiswa')
    <a class="btn btn-success" href="{{route('pengajuan_judul.create') }}">Ajukan Judul</a>
    <a class="btn btn-info" href="{{route('pengajuan_judul.index') }}">Daftar Pengajuan Judul</a>
@endif
@if(auth()->user()->role == 'prodi')
    <a class="btn btn-success" href="{{ route('pengajuan_judul.seleksiIndex') }}">Seleksi Judul</a>
@endif
@if(auth()->user()->role == 'staff_prodi' && $pengajuans->isNotEmpty())
    <table class="table table-bordered">
        <thead class="thead-dark" >
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Abstrak</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $index => $pengajuan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengajuan->judul }}</td>
                    <td>{{ Str::limit($pengajuan->abstrak, 50) }}</td> <!-- Menampilkan hanya 50 karakter pertama -->
                    <td>{{ Str::limit($pengajuan->bukti_pembayaran, 10) }}</td> <!-- Menampilkan hanya 50 karakter pertama -->
                    <td>
                        <a class="btn btn-primary" href="{{ route('upload.surat', $pengajuan->id) }}">
                            Upload Surat Pengantar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-secondary" href="{{ route('laporan.rekapitulasi') }}">Lihat Laporan</a>
@endif

@endsection