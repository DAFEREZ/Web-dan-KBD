@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p>Login sebagai <strong>{{ auth()->user()->username }}</strong>
       (role: <strong>{{ auth()->user()->role->nama_role }}</strong>)</p>
    <p>Login terakhir: {{ auth()->user()->last_login ?? '-' }}</p>
    <p>Hak akses: {{ auth()->user()->role->deskripsi }}</p>
@endsection