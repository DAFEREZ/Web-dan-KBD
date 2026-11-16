<?php

namespace App\Http\Controllers;

use App\Services\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IuranController extends Controller
{
    public function index(Request $request)
    {
        // hanya lewat view: kolom pribadi tidak pernah di-query
        $data = DB::table('v_iuran_anggota')->orderBy('nama')->get();
        $lunas = $data->where('status_iuran', 'lunas')->count();
        $belum = $data->where('status_iuran', 'belum')->count();
        $bisaUbah = $request->user()->hasRole('ketua');

        Audit::catat('LIHAT', 'v_iuran_anggota', null, 'Melihat data iuran');

        return view('iuran.index', compact('data', 'lunas', 'belum', 'bisaUbah'));
    }

    public function update(Request $request, int $id)
    {
        $d = $request->validate(['status_iuran' => ['required', 'in:lunas,belum']]);

        $nama = DB::table('v_iuran_anggota')->where('id', $id)->value('nama');
        abort_if(is_null($nama), 404);

        DB::table('anggota')->where('id', $id)->update(['status_iuran' => $d['status_iuran']]);

        Audit::catat('UBAH', 'anggota', $id, 'Status iuran ' . $nama . ' menjadi ' . $d['status_iuran']);

        return back()->with('ok', 'Status iuran ' . $nama . ' diubah menjadi ' . $d['status_iuran'] . '.');
    }
}