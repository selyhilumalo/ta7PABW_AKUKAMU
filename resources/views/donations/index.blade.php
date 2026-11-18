@extends('layouts.app')

@section('title', 'Daftar donasi')

@section('content')
    <h1>Daftar donasi</h1>

    <table>
        <thead>
            <tr><th>Donatur</th><th>Campaign</th><th>Nominal</th><th>Status</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            @forelse ($donations as $donation)
                <tr>
                    <td>{{ $donation->donor_name }}</td>
                    <td><a href="{{ route('campaigns.show', $donation->campaign) }}">{{ $donation->campaign->title }}</a></td>
                    <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                    <td><x-status-badge :status="$donation->status" /></td>
                    <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Belum ada donasi.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection