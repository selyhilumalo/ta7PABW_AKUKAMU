@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <h1>Daftar</h1>

    <form action="{{ route('register.store') }}" method="POST" class="card" style="max-width:420px;">
        @csrf

        <label for="name">Nama</label>
        <input id="name" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Kata sandi</label>
        <input id="password" type="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Ulangi kata sandi</label>
        <input id="password_confirmation" type="password" name="password_confirmation">

        <p><button type="submit" class="btn">Daftar</button></p>
    </form>
@endsection