<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $fillable = ['nama', 'jabatan', 'status_iuran'];

    // kolom terenkripsi jangan pernah ikut ke JSON/array
    protected $hidden = ['iv', 'nik', 'no_hp', 'alamat'];

    // Insert lewat stored procedure (enkripsi dilakukan di level database)
    public static function tambah(string $nama, ?string $jabatan, string $nik, ?string $hp, ?string $alamat): void
    {
        DB::statement('CALL sp_tambah_anggota(?, ?, ?, ?, ?)', [$nama, $jabatan, $nik, $hp, $alamat]);
    }

    // Baca data pribadi dalam bentuk terdekripsi (khusus role yang berhak)
    public function scopeDekripsi(Builder $q): Builder
    {
        return $q->select('anggota.id', 'nama', 'jabatan', 'status_iuran')
            ->selectRaw('CAST(AES_DECRYPT(nik, @kunci, iv) AS CHAR) AS nik_dekripsi')
            ->selectRaw('CAST(AES_DECRYPT(no_hp, @kunci, iv) AS CHAR) AS hp_dekripsi')
            ->selectRaw('CAST(AES_DECRYPT(alamat, @kunci, iv) AS CHAR) AS alamat_dekripsi');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'anggota_id');
    }
}