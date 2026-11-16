@extends('layouts.app')
@section('title', 'Audit Log')

@section('content')
    <h1>Audit Log</h1>

    <form method="GET" action="{{ route('admin.audit') }}">
        <label>Filter aksi
            <select name="aksi" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach ($aksiList as $a)
                    <option value="{{ $a }}" @selected(request('aksi') === $a)>{{ $a }}</option>
                @endforeach
            </select>
        </label>
    </form>
    <p><small>200 catatan terakhir.</small></p>

    <table>
        <tr><th>Waktu</th><th>User</th><th>Aksi</th><th>Tabel</th><th>ID</th><th>Keterangan</th><th>IP</th></tr>
        @foreach ($logs as $log)
            <tr>
                <td>{{ $log->waktu }}</td>
                <td>{{ $log->user->username ?? '-' }}</td>
                <td>{{ $log->aksi }}</td>
                <td>{{ $log->tabel }}</td>
                <td>{{ $log->record_id }}</td>
                <td>{{ $log->keterangan }}</td>
                <td>{{ $log->ip_address }}</td>
            </tr>
        @endforeach
    </table>
@endsection