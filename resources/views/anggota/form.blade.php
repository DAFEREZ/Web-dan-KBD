@extends('layouts.app')
@php $edit = ! is_null($a); @endphp
@section('title', $edit ? 'Ubah Anggota' : 'Tambah Anggota')

@section('content')
    <h1>{{ $edit ? 'Ubah Anggota: ' . $a->nama : 'Tambah Anggota' }}</h1>

    <form method="POST" action="{{ $edit ? route('anggota.update', $a->id) : route('anggota.store') }}">
        @csrf
        @if ($edit) @method('PUT') @endif

        <label>Nama
            <input type="text" name="nama" value="{{ old('nama', $a->nama ?? '') }}" required>
        </label>

        <label>Jabatan
            <input type="text" name="jabatan" value="{{ old('jabatan', $a->jabatan ?? '') }}">
        </label>

        <label>NIK
            <input type="text" name="nik" value="{{ old('nik', $a->nik_dekripsi ?? '') }}" maxlength="16" required inputmode="numeric">
            <small>16 digit angka. Disimpan terenkripsi.</small>
        </label>

        <label>No. HP
            <input type="text" name="no_hp" value="{{ old('no_hp', $a->hp_dekripsi ?? '') }}" inputmode="numeric">
            <small>8-15 digit angka. Disimpan terenkripsi.</small>
        </label>

        <label>Alamat
            <input type="text" name="alamat" value="{{ old('alamat', $a->alamat_dekripsi ?? '') }}">
            <small>Disimpan terenkripsi.</small>
        </label>

        <p>
            <button class="btn" type="submit">Simpan</button>
            <a href="{{ route('anggota.index') }}">Batal</a>
        </p>
    </form>
@endsection