<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - PKK Kemanggisan</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; }
        table { border-collapse: collapse; width: 100%; }
        td { padding: .5rem; border-bottom: 1px solid #ddd; }
        td:first-child { width: 160px; color: #555; }
    </style>
</head>
<body>
    <h1>Profil Saya</h1>
    <p>Login sebagai <strong>{{ $user->username }}</strong> (role: <strong>{{ $user->role->nama_role }}</strong>)</p>

    <table>
        <tr><td>Nama</td><td>{{ $anggota->nama }}</td></tr>
        <tr><td>Jabatan</td><td>{{ $anggota->jabatan }}</td></tr>
        <tr><td>Status iuran</td><td>{{ $anggota->status_iuran }}</td></tr>
        <tr><td>NIK</td><td>{{ $anggota->nik_dekripsi }}</td></tr>
        <tr><td>No. HP</td><td>{{ $anggota->hp_dekripsi }}</td></tr>
        <tr><td>Alamat</td><td>{{ $anggota->alamat_dekripsi }}</td></tr>
    </table>

    <p><a href="{{ route('dashboard') }}">Kembali ke dashboard</a></p>
</body>
</html>