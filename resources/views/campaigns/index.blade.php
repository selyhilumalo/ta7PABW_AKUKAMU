@extends('layouts.app')

@section('title', 'Campaign')

@section('content')
    <h1>Campaign donasi</h1>

    @if ($campaigns->isNotEmpty())
        <div class="grid">
            @foreach ($campaigns as $campaign)
                <x-campaign-card :campaign="$campaign" />
            @endforeach
        </div>
    @else
        <p class="muted">Belum ada campaign yang aktif.</p>
    @endif
@endsection