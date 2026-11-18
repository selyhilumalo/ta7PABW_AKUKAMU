@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <h1>Masuk</h1>

    <form action="{{ route('login.attempt') }}" method="POST" class="card" style="max-width:420px;">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Kata sandi</label>
        <input id="password" type="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <p><button type="submit" class="btn">Masuk</button></p>
        <p class="muted">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </form>
@endsection