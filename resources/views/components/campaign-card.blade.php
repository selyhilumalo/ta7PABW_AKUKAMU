@props(['campaign'])

<article class="card">
    @if ($campaign->image)
        <img src="{{ asset('storage/' . $campaign->image) }}"
             alt="{{ $campaign->judul }}"
             style="width:100%; height:160px; object-fit:cover; border-radius:8px; margin-bottom:.8rem;">
    @endif

    <h3><a href="{{ route('campaigns.show', $campaign) }}">{{ $campaign->judul }}</a></h3>
    <p class="muted">{{ \Illuminate\Support\Str::limit($campaign->deskripsi, 100) }}</p>

    <div class="progress"><div style="width: {{ $campaign->progress }}%"></div></div>
    <p class="muted">
        Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}
        dari Rp {{ number_format($campaign->target_dana, 0, ',', '.') }} ({{ $campaign->progress }}%)
    </p>

    <a href="{{ route('campaigns.show', $campaign) }}" class="btn">Donasi sekarang</a>
</article>
