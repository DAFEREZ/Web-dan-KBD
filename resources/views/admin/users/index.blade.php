@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
    <h1>Kelola User</h1>
    <p><a class="btn" href="{{ route('admin.users.create') }}">+ Tambah User</a></p>

    <table>
        <tr><th>ID</th><th>Username</th><th>Role</th><th>Anggota terkait</th><th>Status</th><th>Login terakhir</th><th></th></tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->role->nama_role }}</td>
                <td>{{ $u->anggota->nama ?? '-' }}</td>
                <td>
                    <span class="badge {{ $u->is_active ? 'on' : 'off' }}">{{ $u->is_active ? 'aktif' : 'nonaktif' }}</span>
                </td>
                <td>{{ $u->last_login ?? '-' }}</td>
                <td><a href="{{ route('admin.users.edit', $u) }}">Ubah</a></td>
            </tr>
        @endforeach
    </table>
@endsection