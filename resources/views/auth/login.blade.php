@extends('layouts.app')
@section('title','login')

@section('content')
    <h2>Halaman Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nim">ID (10 Digit Angka):</label>
            <input type="text" class="form-control" id="nim" name="nim" required>
            @error('id_username')
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
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('access'))
    <div class="alert alert-danger">
        {{ $errors->first('access') }}
    </div>
@endif


@endsection
