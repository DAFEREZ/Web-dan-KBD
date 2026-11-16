<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        // anggota hanya diambil id & nama, kolom terenkripsi tidak pernah disentuh
        $users = User::with(['role', 'anggota:id,nama'])->orderBy('id')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'user'    => new User(['is_active' => true]),
            'roles'   => Role::orderBy('id')->get(),
            'anggota' => $this->daftarAnggota(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username'   => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'password'   => ['required', 'string', Password::min(8)->letters()->numbers()],
            'role_id'    => ['required', 'exists:roles,id'],
            'anggota_id' => ['nullable', 'exists:anggota,id', 'unique:users,anggota_id'],
        ]);

        $user = User::create([
            'username'      => $data['username'],
            'password_hash' => Hash::make($data['password']),
            'role_id'       => $data['role_id'],
            'anggota_id'    => $data['anggota_id'] ?? null,
            'is_active'     => $request->boolean('is_active'),
        ]);

        Audit::catat('TAMBAH', 'users', $user->id, 'Membuat user ' . $user->username . ' (role ' . $user->role->nama_role . ')');

        return redirect()->route('admin.users')->with('ok', 'User ' . $user->username . ' berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', [
            'user'    => $user,
            'roles'   => Role::orderBy('id')->get(),
            'anggota' => $this->daftarAnggota(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'password'   => ['nullable', 'string', Password::min(8)->letters()->numbers()],
            'role_id'    => ['required', 'exists:roles,id'],
            'anggota_id' => ['nullable', 'exists:anggota,id', Rule::unique('users', 'anggota_id')->ignore($user->id)],
        ]);

        $aktif = $request->boolean('is_active');

        // admin tidak boleh mengunci dirinya sendiri
        if ($user->id === $request->user()->id
            && ((int) $data['role_id'] !== (int) $user->role_id || ! $aktif)) {
            return back()->withInput()->withErrors([
                'role_id' => 'Anda tidak dapat mengubah role atau menonaktifkan akun Anda sendiri.',
            ]);
        }

        $user->role_id    = $data['role_id'];
        $user->anggota_id = $data['anggota_id'] ?? null;
        $user->is_active  = $aktif;
        if (! empty($data['password'])) {
            $user->password_hash = Hash::make($data['password']);
        }

        $berubah = array_keys($user->getDirty());
        $berubah = array_map(fn ($k) => $k === 'password_hash' ? 'password (direset)' : $k, $berubah);
        $user->save();

        Audit::catat('UBAH', 'users', $user->id, 'Mengubah user ' . $user->username . ': ' . ($berubah ? implode(', ', $berubah) : 'tanpa perubahan'));

        return redirect()->route('admin.users')->with('ok', 'User ' . $user->username . ' berhasil diperbarui.');
    }

    private function daftarAnggota()
    {
        return DB::table('v_iuran_anggota')->select('id', 'nama')->orderBy('nama')->get();
    }
}