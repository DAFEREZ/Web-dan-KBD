<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = ['username', 'password_hash', 'role_id', 'anggota_id', 'is_active', 'last_login'];
    protected $hidden = ['password_hash'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'last_login' => 'datetime'];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role->nama_role, $roles, true);
    }

        // tabel users gak punya kolom remember_token
    public function getRememberTokenName()
    {
        return '';
    }

    // supaya Laravel nulis ulang hash ke kolom yang bener kalau perlu rehash
    public function getAuthPasswordName()
    {
        return 'password_hash';
    }
}