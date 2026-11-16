@extends('layouts.app')
@php $edit = $user->exists; @endphp
@section('title', $edit ? 'Ubah User' : 'Tambah User')

@section('content')
    <h1>{{ $edit ? 'Ubah User: ' . $user->username : 'Tambah User' }}</h1>

    <form method="POST" action="{{ $edit ? route('admin.users.update', $user) : route('admin.users.store') }}">
        @csrf
        @if ($edit) @method('PUT') @endif

        @unless ($edit)
            <label>Username
                <input type="text" name="username" value="{{ old('username') }}" required>
                <small>Huruf, angka, strip, dan underscore.</small>
            </label>
        @endunless

        <label>Password {{ $edit ? '(kosongkan jika tidak diganti)' : '' }}
            <input type="password" name="password" {{ $edit ? '' : 'required' }} autocomplete="new-password">
            <small>Minimal 8 karakter, mengandung huruf dan angka.</small>
        </label>

        <label>Role
            <select name="role_id" required>
                @foreach ($roles as $r)
                    <option value="{{ $r->id }}" @selected(old('role_id', $user->role_id) == $r->id)>
                        {{ $r->nama_role }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>Tautkan ke anggota
            <select name="anggota_id">
                <option value="">- tidak ditautkan -</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}" @selected(old('anggota_id', $user->anggota_id) == $a->id)>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </label>

        <label>
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active))>
            Akun aktif
        </label>

        <p>
            <button class="btn" type="submit">Simpan</button>
            <a href="{{ route('admin.users') }}">Batal</a>
        </p>
    </form>
@endsection