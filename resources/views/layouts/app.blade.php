<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Donasi') | Aku &amp; Kamu</title>
    <style>
        :root {
            --ink:#2a2140;
            --hydra:#6d54a8;        /* ungu hydrangea utama */
            --hydra-dark:#533e8a;
            --hydra-soft:#eee9f8;
            --hydra-mid:#b9a9e0;
            --line:#e2dcef;
            --bg:#f8f6fc;
        }
        * { box-sizing: border-box; }
        body { margin:0; font-family: system-ui, sans-serif; color:var(--ink); background:var(--bg); line-height:1.6; }
        a { color:var(--hydra); }
        a:hover { color:var(--hydra-dark); }
        .container { max-width:1000px; margin:0 auto; padding:0 1rem; }

        header { background:#fff; border-bottom:3px solid var(--hydra-mid); }
        .bar { display:flex; align-items:center; gap:1.5rem; padding:.9rem 0; }
        .brand { font-weight:700; font-size:1.2rem; text-decoration:none; margin-right:auto; color:var(--hydra); }
        nav a { text-decoration:none; padding:.3rem .6rem; border-radius:6px; }
        nav a:hover { background:var(--hydra-soft); }
        nav a.active { background:var(--hydra); color:#fff; }

        main { padding:2rem 0; min-height:70vh; }
        footer { border-top:1px solid var(--line); padding:1.5rem 0; color:#6b6480; font-size:.9rem; background:#fff; }

        .grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.25rem; }
        .card { background:#fff; border:1px solid var(--line); border-radius:10px; padding:1.25rem; }
        .two { display:grid; grid-template-columns:1.2fr 1fr; gap:1.5rem; }
        @media (max-width:760px) { .two { grid-template-columns:1fr; } }

        .progress { height:8px; background:var(--hydra-soft); border-radius:99px; overflow:hidden; margin:.8rem 0 .4rem; }
        .progress > div { height:100%; background:linear-gradient(90deg, var(--hydra-mid), var(--hydra)); }
        .muted { color:#6b6480; font-size:.92rem; }

        .btn { display:inline-block; background:var(--hydra); color:#fff; border:0; padding:.6rem 1.1rem; border-radius:8px; text-decoration:none; cursor:pointer; font-size:1rem; }
        .btn:hover { background:var(--hydra-dark); color:#fff; }
        .btn-sm { padding:.3rem .7rem; font-size:.9rem; }
        .btn-danger { background:#b42318; }
        .btn-danger:hover { background:#8f1c12; }

        label { display:block; margin:.8rem 0 .25rem; font-weight:600; }
        input, textarea, select { width:100%; padding:.55rem .7rem; border:1px solid #cfc6e6; border-radius:8px; font:inherit; background:#fff; }
        input:focus, textarea:focus, select:focus { outline:2px solid var(--hydra-mid); border-color:var(--hydra); }
        input[type="file"] { padding:.4rem; }
        .error { color:#b42318; font-size:.85rem; }
        .alert { background:var(--hydra-soft); border:1px solid var(--hydra-mid); padding:.8rem 1rem; border-radius:8px; margin-bottom:1.25rem; }

        table { width:100%; border-collapse:collapse; background:#fff; }
        th, td { text-align:left; padding:.7rem; border-bottom:1px solid var(--line); vertical-align:middle; }
        th { background:var(--hydra-soft); }
        .badge { padding:.15rem .6rem; border-radius:99px; font-size:.8rem; }
        .badge-success { background:#d6f1e3; color:#14633f; }
        .badge-warning { background:#fdf0cf; color:#7a5300; }

        .thumb { width:90px; height:60px; object-fit:cover; border-radius:6px; border:1px solid var(--line); }
        .actions { display:flex; gap:.8rem; align-items:center; }
        .actions form { margin:0; }
    </style>
</head>
<body>
    @include('partials.header')

    <main class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>