<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Str;

class Audit
{
    public static function catat(
        string $aksi,
        ?string $tabel = null,
        ?int $recordId = null,
        ?string $keterangan = null,
        ?int $userId = null
    ): void {
        AuditLog::create([
            'user_id'    => $userId ?? auth()->id(),
            'aksi'       => $aksi,
            'tabel'      => $tabel,
            'record_id'  => $recordId,
            'keterangan' => $keterangan ? Str::limit($keterangan, 255, '') : null,
            'ip_address' => request()->ip(),
        ]);
    }
}