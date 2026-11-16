<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Services\Audit;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        abort_if(is_null($user->anggota_id), 403, 'Akun ini tidak terhubung ke data anggota.');

        $anggota = Anggota::dekripsi()->where('anggota.id', $user->anggota_id)->firstOrFail();

        Audit::catat('LIHAT', 'anggota', $user->anggota_id, 'Melihat profil sendiri (data terdekripsi)');

        return view('profil', compact('user', 'anggota'));
    }
}