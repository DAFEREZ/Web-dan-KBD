@extends('layouts.app')
@section('title', 'Data Anggota')

@section('content')
    <h1>Data Anggota</h1>
    <p><a class="btn" href="{{ route('anggota.create') }}">+ Tambah Anggota</a></p>

    @unless ($penuh)
        <p><small>Sebagai {{ auth()->user()->role->nama_role }}, NIK dan No. HP ditampilkan tersamar. Nilai lengkap hanya terbuka di form ubah dan tercatat di audit log.</small></p>
    @endunless

    <table>
        <tr><th>Nama</th><th>Jabatan</th><th>NIK</th><th>No. HP</th><th>Alamat</th><th>Iuran</th><th></th></tr>
        @foreach ($anggota as $a)
            <tr>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->jabatan }}</td>
                <td>{{ $a->nik_tampil }}</td>
                <td>{{ $a->hp_tampil }}</td>
                <td>{{ $a->alamat_tampil }}</td>
                <td><span class="badge {{ $a->status_iuran === 'lunas' ? 'on' : 'off' }}">{{ $a->status_iuran }}</span></td>
                <td><a href="{{ route('anggota.edit', $a->id) }}">Ubah</a></td>
            </tr>
        @endforeach
    </table>
@endsection