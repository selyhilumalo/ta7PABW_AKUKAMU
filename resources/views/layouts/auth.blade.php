<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Aku & Kamu</title>
    <style>
        :root{--ungu:#6d28d9;--ungu-tua:#4c1d95;--ungu-muda:#f3ecff;--latar:#faf7ff;--teks:#1b1530;--lembut:#5d5675;--garis:#e6dff5}
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:system-ui,-apple-system,'Segoe UI',sans-serif;background:var(--latar);color:var(--teks);line-height:1.5;min-height:100vh;display:grid;place-items:center;padding:24px}
        a{color:var(--ungu);font-weight:700;text-decoration:none}
        .card{width:100%;max-width:440px;background:#fff;border:1px solid var(--garis);border-radius:20px;padding:32px;box-shadow:0 8px 24px rgba(76,29,149,.08)}
        h1{font-size:26px;line-height:1.2}
        .sub{color:var(--lembut);font-size:14px;margin:6px 0 16px}
        label{display:block;font-size:13px;font-weight:700;margin:14px 0 6px}
        input[type=text],input[type=email],input[type=password]{width:100%;padding:11px 12px;border:1.5px solid var(--garis);border-radius:10px;font:inherit}
        input:focus{border-color:#a78bfa;outline:none}
        input.is-invalid{border-color:#dc2626;background:#fff5f5}
        .check{display:flex;align-items:center;gap:8px;font-weight:500}
        .hint{display:block;font-size:12px;color:var(--lembut);margin-top:4px}
        .error{display:block;color:#b91c1c;font-size:12px;margin-top:4px}
        .btn{display:block;width:100%;margin-top:18px;padding:12px;border:0;border-radius:999px;background:var(--ungu);color:#fff;font:inherit;font-weight:700;cursor:pointer;text-align:center}
        .btn:hover{background:var(--ungu-tua)}
        .btn-outline{background:#fff;color:var(--ungu);border:1.5px solid #c4b5fd}
        .alt{text-align:center;font-size:13px;color:var(--lembut);margin-top:18px}
        .alert{margin:12px 0;padding:11px 14px;border-radius:12px;font-size:14px}
        .alert-success{background:#e7f8ee;border:1px solid #9be0b8;color:#14532d}
        .alert-danger{background:#fef2f2;border:1px solid #fecaca;color:#991b1b}
        table{width:100%;border-collapse:collapse;margin-top:12px;font-size:14px}
        td{padding:9px 0;border-bottom:1px solid var(--garis)}
        td:first-child{color:var(--lembut);width:35%}
    </style>
</head>
<body>
    <div class="card">
        @yield('content')
    </div>
</body>
</html>