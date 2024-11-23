@extends('layouts.app')
@section('title','register')

@section('content')
    <h2>Pendaftaran Akun</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nim">ID (10 Digit Angka):</label>
            <input type="text" class="form-control" id="nim" name="nim" required>
            @error('nim')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="prodi">Prodi</option>
                <option value="staff_prodi">Staff Prodi</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
@endsection
