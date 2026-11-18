@extends('layouts.auth')

@section('title', 'Profil')

@section('content')
    <h1>Profil saya</h1>
    <p class="sub">Halaman ini hanya bisa dibuka setelah login (middleware auth).</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <tr><td>Nama</td><td>{{ auth()->user()->name }}</td></tr>
        <tr><td>Email</td><td>{{ auth()->user()->email }}</td></tr>
        <tr><td>Terdaftar</td><td>{{ auth()->user()->created_at?->format('d M Y H:i') }}</td></tr>
    </table>

    <a href="{{ route('home') }}" class="btn btn-outline">Kembali ke beranda</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn">Logout</button>
    </form>
@endsection