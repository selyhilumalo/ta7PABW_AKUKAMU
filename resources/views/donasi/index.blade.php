<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campaign Donasi - Aku &amp; Kamu</title>

    <style>
        body {
            font-family: system-ui, sans-serif;
            margin: 0;
            background: #faf7ff;
            color: #1a1033;
        }

        header,
        footer {
            padding: 16px 40px;
        }

        header {
            background: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .akun {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .akun form {
            margin: 0;
        }

        .akun a {
            color: #6d28d9;
            text-decoration: none;
            font-weight: 700;
        }

        .akun button {
            background: #6d28d9;
            color: #fff;
            border: 0;
            padding: 7px 18px;
            border-radius: 99px;
            font: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .akun .daftar {
            background: #6d28d9;
            color: #fff;
            padding: 7px 18px;
            border-radius: 99px;
            font-size: 12px;
        }

        .alert {
            background: #e7f8ee;
            border: 1px solid #9be0b8;
            color: #14532d;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            margin-bottom: 16px;
        }

        footer {
            background: #111a33;
            color: #fff;
            margin-top: 48px;
        }

        main {
            padding: 32px 40px;
        }

        .label {
            color: #6d28d9;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        h1 {
            font-size: 36px;
            margin: 4px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 28px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e0f0;
            border-radius: 14px;
            overflow: hidden;
        }

        .thumb {
            background: #fde4e4;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            position: relative;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #fff;
            padding: 2px 10px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 700;
            color: #6d28d9;
        }

        .body {
            padding: 16px;
        }

        .body h3 {
            font-size: 15px;
            margin: 0 0 6px;
        }

        .body p {
            font-size: 11px;
            color: #555;
        }

        .row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            color: #6d28d9;
        }

        .bar {
            background: #ece8f5;
            height: 6px;
            border-radius: 99px;
            margin: 6px 0;
        }

        .bar > span {
            display: block;
            height: 100%;
            background: #ef4444;
            border-radius: 99px;
        }

        small {
            font-size: 10px;
            color: #666;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            background: #6d28d9;
            color: #fff;
            padding: 8px 20px;
            border-radius: 99px;
            font-size: 12px;
            text-decoration: none;
            font-weight: 700;
        }

        .kosong {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: #fff;
            border: 1px dashed #e5e0f0;
            border-radius: 14px;
            color: #666;
        }
    </style>
</head>

<body>

    <header>
        <a href="{{ route('home') }}" style="color:inherit;text-decoration:none">
            Aku &amp; Kamu — Social Platform
        </a>

        <div class="akun">
            @auth
                <a href="{{ route('profil') }}">{{ auth()->user()->name }}</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('daftar') }}" class="daftar">Daftar</a>
            @endauth
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="label">KONTEN PUBLIK</div>

        <h1>Campaign Donasi</h1>

        <p>
            Pilih campaign sosial yang ingin didukung secara transparan.
        </p>

        <div class="grid">

            @forelse ($campaigns as $c)
                <div class="card">

                    <div class="thumb">
                        <span class="badge">
                            {{ $c->kategori->nama }}
                        </span>

                        💝
                    </div>

                    <div class="body">

                        <h3>
                            {{ $c->judul }}
                        </h3>

                        <p>
                            {{ $c->deskripsi }}
                        </p>

                        <div class="row">
                            <span>
                                Rp {{ number_format($c->dana_terkumpul, 0, ',', '.') }}
                            </span>

                            <span>
                                {{ $c->persentase }}%
                            </span>
                        </div>

                        <div class="bar">
                            <span style="width: {{ min($c->persentase, 100) }}%"></span>
                        </div>

                        <small>
                            Terkumpul dari target Rp
                            {{ number_format($c->target_dana, 0, ',', '.') }}
                        </small>

                        <br>

                        <a href="{{ route('donasi.show', $c->id) }}" class="btn">
                            Detail
                        </a>

                    </div>
                </div>
            @empty
                <div class="kosong">Belum ada campaign donasi yang aktif.</div>
            @endforelse

        </div>
    </main>

    <footer>
        <strong>Aku &amp; Kamu</strong> — Platform sosial digital untuk donasi,
        volunteer, edukasi keluarga, laporan sosial, konsultasi, dan pemetaan
        wilayah rawan.
    </footer>

</body>
</html>