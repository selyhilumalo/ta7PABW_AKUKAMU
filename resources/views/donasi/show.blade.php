
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $campaign->judul }} | Aku &amp; Kamu</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, 'Segoe UI', sans-serif;
            background: #faf7ff;
            color: #1a1033;
            line-height: 1.55;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            padding: 16px 40px;
            background: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 700;
        }

        header a.judul {
            color: inherit;
            text-decoration: none;
        }

        .akun {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
        }

        .akun form {
            margin: 0;
        }

        a {
            color: #6d28d9;
            font-weight: 700;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 8px 20px;
            border: 0;
            border-radius: 99px;
            background: #6d28d9;
            color: #fff;
            font: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 28px;
            margin-top: 16px;
        }

        .box {
            background: #fff;
            border: 1px solid #e5e0f0;
            border-radius: 14px;
            padding: 24px;
        }

        .chip {
            display: inline-block;
            background: #f3ecff;
            color: #6d28d9;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 99px;
        }

        h1 {
            font-size: 28px;
            margin: 12px 0 8px;
        }

        .lead {
            color: #555;
            margin-bottom: 20px;
        }

        .rp {
            color: #6d28d9;
            font-weight: 800;
            font-size: 20px;
        }

        .track {
            height: 8px;
            background: #ece8f5;
            border-radius: 99px;
            margin: 8px 0;
            overflow: hidden;
        }

        .fill {
            height: 100%;
            background: #ef4444;
        }

        small {
            color: #666;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin: 14px 0 6px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid #e5e0f0;
            border-radius: 10px;
            font: inherit;
        }

        .error {
            display: block;
            color: #b91c1c;
            font-size: 12px;
            margin-top: 4px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            background: #e7f8ee;
            border: 1px solid #9be0b8;
            color: #14532d;
            margin: 16px 0;
        }

        footer {
            background: #111a33;
            color: #fff;
            padding: 16px 40px;
            margin-top: 48px;
        }

        @media (max-width: 800px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <header>
        <a href="{{ route('home') }}" class="judul">
            Aku &amp; Kamu — Social Platform
        </a>

        <div class="akun">
            <a href="{{ route('home') }}">Beranda</a>

            <a href="{{ route('profil') }}">
                {{ auth()->user()->name }}
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main>
        <a href="{{ route('home') }}">
            &larr; Kembali ke daftar campaign
        </a>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid">

            <div class="box">
                <span class="chip">
                    {{ $campaign->kategori->nama }}
                </span>

                <h1>
                    {{ $campaign->judul }}
                </h1>

                <p class="lead">
                    {{ $campaign->deskripsi }}
                </p>

                <span class="rp">
                    Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}
                </span>

                <div class="track">
                    <div class="fill" style="width: {{ min($campaign->persentase, 100) }}%"></div>
                </div>

                <small>
                    {{ $campaign->persentase }}% — terkumpul dari target Rp
                    {{ number_format($campaign->target_dana, 0, ',', '.') }}
                </small>
                                <h2 style="font-size:18px;margin:28px 0 12px">Donatur terbaru</h2>
                @forelse ($donatur as $d)
                    <div style="display:flex;justify-content:space-between;gap:16px;padding:12px 0;border-bottom:1px solid #ece8f5;font-size:14px">
                        <div>
                            <strong>{{ $d->nama_donatur }}</strong>
                            @if ($d->pesan)
                                <div style="font-size:12px;color:#666">“{{ $d->pesan }}”</div>
                            @endif
                        </div>
                        <span style="font-weight:700;color:#6d28d9;white-space:nowrap">
                            Rp {{ number_format($d->jumlah, 0, ',', '.') }}
                        </span>
                    </div>
                @empty
                    <p style="color:#666;font-size:14px">Belum ada donatur. Jadilah yang pertama.</p>
                @endforelse
            </div>

            <div class="box">
                <h2 style="font-size:18px">
                    Donasi sekarang
                </h2>

                <form action="{{ route('donasi.store', $campaign->id) }}" method="POST">
                    @csrf

                    <label for="nama">Nama</label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama', auth()->user()->name) }}"
                    >

                    @error('nama')
                        <small class="error">{{ $message }}</small>
                    @enderror

                    <label for="nominal">Nominal (Rp)</label>

                    <input
                        type="number"
                        id="nominal"
                        name="nominal"
                        min="10000"
                        step="1000"
                        value="{{ old('nominal') }}"
                    >

                    @error('nominal')
                        <small class="error">{{ $message }}</small>
                    @enderror

                    <label for="pesan">Pesan (opsional)</label>

                    <textarea
                        id="pesan"
                        name="pesan"
                        rows="3"
                    >{{ old('pesan') }}</textarea>

                    @error('pesan')
                        <small class="error">{{ $message }}</small>
                    @enderror

                    <button
                        type="submit"
                        class="btn"
                        style="width:100%;margin-top:16px"
                    >
                        Kirim donasi
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer>
        <strong>Aku &amp; Kamu</strong> — Platform sosial digital untuk donasi,
        volunteer, edukasi keluarga, laporan sosial, konsultasi, dan pemetaan
        wilayah rawan.
    </footer>

</body>

</html>
