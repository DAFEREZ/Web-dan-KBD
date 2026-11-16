<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_log';
    public $timestamps = false;
    protected $fillable = ['user_id', 'aksi', 'tabel', 'record_id', 'keterangan', 'ip_address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}