@extends('layouts.app')

@section('title', $campaign->judul)

@section('content')
    <div class="two">
        <section>
            @if ($campaign->image)
                <img src="{{ asset('storage/' . $campaign->image) }}"
                     alt="{{ $campaign->judul }}"
                     style="width:100%; max-height:320px; object-fit:cover; border-radius:10px; margin-bottom:1rem;">
            @endif

            <h1>{{ $campaign->judul }}</h1>
            <p>{{ $campaign->deskripsi }}</p>

            <div class="progress"><div style="width: {{ $campaign->progress }}%"></div></div>
            <p class="muted">
                Terkumpul Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}
                dari Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}
            </p>

            <h2>Donatur terbaru</h2>
            @forelse ($donors as $donor)
                <p>
                    <strong>{{ $donor->donor_name }}</strong>
                    memberi Rp {{ number_format($donor->amount, 0, ',', '.') }}
                    @if ($donor->message)
                        <br><span class="muted">"{{ $donor->message }}"</span>
                    @endif
                </p>
            @empty
                <p class="muted">Jadilah donatur pertama.</p>
            @endforelse
        </section>

        <aside class="card">
            <h2>Form donasi</h2>
            <form action="{{ route('donations.store', $campaign) }}" method="POST">
                @csrf

                <label for="donor_name">Nama</label>
                <input id="donor_name" name="donor_name" value="{{ old('donor_name') }}">
                @error('donor_name') <div class="error">{{ $message }}</div> @enderror

                <label for="donor_email">Email</label>
                <input id="donor_email" type="email" name="donor_email" value="{{ old('donor_email') }}">
                @error('donor_email') <div class="error">{{ $message }}</div> @enderror

                <label for="amount">Nominal (Rp)</label>
                <input id="amount" type="number" name="amount" min="10000" step="1000" value="{{ old('amount') }}">
                @error('amount') <div class="error">{{ $message }}</div> @enderror

                <label for="message">Pesan (opsional)</label>
                <textarea id="message" name="message" rows="3">{{ old('message') }}</textarea>
                @error('message') <div class="error">{{ $message }}</div> @enderror

                <p><button type="submit" class="btn">Kirim donasi</button></p>
            </form>
        </aside>
    </div>
@endsection