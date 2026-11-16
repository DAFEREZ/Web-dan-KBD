<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - PKK Kemanggisan</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f9fafb; color: #111827; }
        nav { background: #0f766e; color: #fff; padding: .6rem 1rem; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }
        nav a { color: #fff; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        nav .sp { flex: 1; }
        nav form { margin: 0; }
        nav button { cursor: pointer; padding: .25rem .6rem; }
        main { max-width: 1000px; margin: 1.5rem auto; padding: 0 1rem; }
        table { border-collapse: collapse; width: 100%; font-size: .9rem; background: #fff; }
        th, td { padding: .5rem; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f3f4f6; }
        .ok { background: #dcfce7; color: #166534; padding: .6rem; border-radius: 4px; margin-bottom: 1rem; }
        .err { background: #fee2e2; color: #991b1b; padding: .6rem; border-radius: 4px; margin-bottom: 1rem; }
        .err ul { margin: 0; padding-left: 1.2rem; }
        .btn { display: inline-block; padding: .4rem .8rem; background: #0f766e; color: #fff; border: 0; border-radius: 4px; text-decoration: none; cursor: pointer; font-size: .9rem; }
        .badge { padding: .1rem .5rem; border-radius: 999px; font-size: .75rem; }
        .on { background: #dcfce7; color: #166534; }
        .off { background: #fee2e2; color: #991b1b; }
        label { display: block; margin-top: .8rem; font-size: .9rem; }
        input[type=text], input[type=password], select { width: 100%; max-width: 360px; padding: .45rem; margin-top: .25rem; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        small { color: #6b7280; }
    </style>
</head>
<body>
@php $role = auth()->user()->role->nama_role; @endphp
<nav>
    <strong>PKK Kemanggisan</strong>
    <a href="{{ route('dashboard') }}">Dashboard</a>

    @if ($role === 'admin')
        <a href="{{ route('admin.users') }}">Kelola User</a>
        <a href="{{ route('admin.audit') }}">Audit Log</a>
    @endif
    @if (in_array($role, ['ketua', 'sekretaris', 'bendahara', 'anggota']))
        <a href="{{ route('profil') }}">Profil Saya</a>
    @endif
    @if (in_array($role, ['ketua', 'sekretaris']))
        <a href="{{ route('anggota.index') }}">Data Anggota</a>
    @endif
    @if (in_array($role, ['ketua', 'bendahara']))
        <a href="{{ route('iuran.index') }}">Iuran</a>
    @endif

    <span class="sp"></span>
    <span>{{ auth()->user()->username }} ({{ $role }})</span>
    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Logout</button></form>
</nav>

<main>
    @if (session('ok'))
        <div class="ok">{{ session('ok') }}</div>
    @endif
    @if ($errors->any())
        <div class="err"><ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    @yield('content')
</main>
</body>
</html>