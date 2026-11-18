@extends('layouts.app')

@section('title', 'Tambah campaign')

@section('content')
    <h1>Tambah campaign</h1>

    <form action="{{ route('manage.campaigns.store') }}" method="POST" enctype="multipart/form-data" class="card">
        @include('manage.campaigns._form')
    </form>
@endsection