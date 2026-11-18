@extends('layouts.app')

@section('title', 'Edit campaign')

@section('content')
    <h1>Edit campaign</h1>

    <form action="{{ route('manage.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data" class="card">
        @method('PUT')
        @include('manage.campaigns._form')
    </form>
@endsection