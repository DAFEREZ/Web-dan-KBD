<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; max-width: 420px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h1 { color: #991b1b; margin: 0 0 .5rem; }
        a { color: #0f766e; }
    </style>
</head>
<body>
    <div class="card">
        <h1>403</h1>
        <p><strong>Akses ditolak.</strong></p>
        <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses ke halaman ini.' }}</p>
        <a href="{{ route('dashboard') }}">Kembali ke dashboard</a>
    </div>
</body>
</html>