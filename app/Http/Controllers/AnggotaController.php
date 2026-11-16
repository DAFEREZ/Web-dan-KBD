<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Services\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $penuh = $request->user()->hasRole('ketua');

        $anggota = Anggota::dekripsi()->orderBy('nama')->get()->map(function ($a) use ($penuh) {
            $a->nik_tampil    = $penuh ? $a->nik_dekripsi : $this->samar($a->nik_dekripsi, 4, 4);
            $a->hp_tampil     = $penuh ? $a->hp_dekripsi : $this->samar($a->hp_dekripsi, 4, 3);
            $a->alamat_tampil = $penuh ? $a->alamat_dekripsi : Str::limit((string) $a->alamat_dekripsi, 15);
            return $a;
        });

        Audit::catat('LIHAT', 'anggota', null, 'Melihat daftar anggota (' . ($penuh ? 'data penuh' : 'data tersamar') . ')');

        return view('anggota.index', compact('anggota', 'penuh'));
    }

    public function create()
    {
        return view('anggota.form', ['a' => null]);
    }

    public function store(Request $request)
    {
        $d = $this->validasi($request);

        if ($this->nikSudahAda($d['nik'])) {
            return back()->withInput()->withErrors(['nik' => 'NIK sudah terdaftar.']);
        }

        // enkripsi dilakukan di database lewat stored procedure
        Anggota::tambah($d['nama'], $d['jabatan'] ?? null, $d['nik'], $d['no_hp'] ?? null, $d['alamat'] ?? null);
        $id = (int) DB::selectOne('SELECT LAST_INSERT_ID() AS id')->id;

        Audit::catat('TAMBAH', 'anggota', $id, 'Menambah anggota ' . $d['nama']);

        return redirect()->route('anggota.index')->with('ok', 'Anggota ' . $d['nama'] . ' berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $a = Anggota::dekripsi()->where('anggota.id', $id)->firstOrFail();

        Audit::catat('LIHAT', 'anggota', $id, 'Membuka form ubah (data terdekripsi)');

        return view('anggota.form', compact('a'));
    }

    public function update(Request $request, int $id)
    {
        $anggota = Anggota::findOrFail($id);
        $d = $this->validasi($request);

        if ($this->nikSudahAda($d['nik'], $id)) {
            return back()->withInput()->withErrors(['nik' => 'NIK sudah dipakai anggota lain.']);
        }

        // enkripsi ulang memakai IV milik baris itu sendiri
        DB::update(
            'UPDATE anggota SET nama = ?, jabatan = ?,
                nik    = AES_ENCRYPT(?, @kunci, iv),
                no_hp  = AES_ENCRYPT(?, @kunci, iv),
                alamat = AES_ENCRYPT(?, @kunci, iv)
             WHERE id = ?',
            [$d['nama'], $d['jabatan'] ?? null, $d['nik'], $d['no_hp'] ?? null, $d['alamat'] ?? null, $id]
        );

        // nilai pribadi tidak pernah ditulis ke audit log
        Audit::catat('UBAH', 'anggota', $id, 'Mengubah data anggota ' . $anggota->nama);

        return redirect()->route('anggota.index')->with('ok', 'Data ' . $d['nama'] . ' berhasil diperbarui.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama'    => ['required', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:50'],
            'nik'     => ['required', 'digits:16'],
            'no_hp'   => ['nullable', 'regex:/^[0-9]{8,15}$/'],
            'alamat'  => ['nullable', 'string', 'max:255'],
        ], [
            'nik.digits'   => 'NIK harus 16 digit angka.',
            'no_hp.regex'  => 'No. HP harus 8-15 digit angka.',
        ]);
    }

    private function nikSudahAda(string $nik, ?int $kecuali = null): bool
    {
        $q = DB::table('anggota')->whereRaw('CAST(AES_DECRYPT(nik, @kunci, iv) AS CHAR) = ?', [$nik]);
        if ($kecuali) {
            $q->where('id', '<>', $kecuali);
        }
        return $q->exists();
    }

    private function samar(?string $v, int $depan, int $belakang): string
    {
        if (! $v) {
            return '-';
        }
        $n = strlen($v);
        if ($n <= $depan + $belakang) {
            return str_repeat('*', $n);
        }
        return substr($v, 0, $depan) . str_repeat('*', $n - $depan - $belakang) . substr($v, -$belakang);
    }
}