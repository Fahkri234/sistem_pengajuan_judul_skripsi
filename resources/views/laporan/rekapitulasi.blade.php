@extends('layouts.app')
@section('title', 'Laporan Rekapitulasi')
@section('content')

<h1 class="text-center" >Laporan Rekapitulasi Pengajuan Judul Skripsi</h1>

<table class="table table-bordered">
    <thead class="thead-dark" >
        <tr>
            <th>Jenis Laporan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jumlah Judul Diterima</td>
            <td>{{ $jumlahDiterima }}</td>
        </tr>
        <tr>
            <td>Jumlah Judul Diterima dan Sudah Melakukan Pembayaran</td>
            <td>{{ $jumlahDenganPembayaran }}</td>
        </tr>
    </tbody>
</table>

@endsection
