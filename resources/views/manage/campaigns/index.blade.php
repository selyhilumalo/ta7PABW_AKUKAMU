@extends('layouts.app')

@section('title', 'Kelola campaign')

@section('content')
    <p style="display:flex; justify-content:space-between; align-items:center;">
        <span style="font-size:1.6rem; font-weight:700;">Kelola campaign</span>
        <a href="{{ route('manage.campaigns.create') }}" class="btn">Tambah campaign</a>
    </p>

    <table>
        <thead>
            <tr><th>Gambar</th><th>Judul</th><th>Target</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($campaigns as $campaign)
                <tr>
                    <td>
                        @if ($campaign->image)
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->judul }}" class="thumb">
                        @else
                            <span class="muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $campaign->judul }}</td>
                    <td>Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($campaign->status) }}</td>
                    <td>
                        <div class="actions">
                            @if ($campaign->image)
                                <a href="{{ route('manage.campaigns.download', $campaign) }}">Unduh</a>
                            @endif
                            <a href="{{ route('manage.campaigns.edit', $campaign) }}">Edit</a>
                            <form action="{{ route('manage.campaigns.destroy', $campaign) }}" method="POST"
                                  onsubmit="return confirm('Hapus campaign ini beserta gambarnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Belum ada campaign. Klik "Tambah campaign".</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection