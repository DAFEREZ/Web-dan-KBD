@extends('layouts.app')
@section('title', 'Iuran')

@section('content')
    <h1>Data Iuran</h1>
    <p>Lunas: <strong>{{ $lunas }}</strong> &middot; Belum: <strong>{{ $belum }}</strong></p>
    <p><small>Data diambil dari view <code>v_iuran_anggota</code>. NIK, No. HP, dan alamat tidak dapat diakses dari halaman ini.</small></p>

    <table>
        <tr><th>Nama</th><th>Jabatan</th><th>Status iuran</th>@if ($bisaUbah)<th></th>@endif</tr>
        @foreach ($data as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->jabatan }}</td>
                <td><span class="badge {{ $r->status_iuran === 'lunas' ? 'on' : 'off' }}">{{ $r->status_iuran }}</span></td>
                @if ($bisaUbah)
                    <td>
                        <form method="POST" action="{{ route('iuran.update', $r->id) }}" style="margin:0">
                            @csrf @method('PUT')
                            <input type="hidden" name="status_iuran" value="{{ $r->status_iuran === 'lunas' ? 'belum' : 'lunas' }}">
                            <button class="btn" type="submit">Tandai {{ $r->status_iuran === 'lunas' ? 'belum' : 'lunas' }}</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection