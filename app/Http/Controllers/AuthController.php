<?php

namespace App\Http\Controllers;

use App\Services\Audit;
use App\Services\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        $ok = Auth::attempt([
            'username'  => $input['username'],
            'password'  => $input['password'],
            'is_active' => 1,
        ]);

        if (! $ok) {
            Audit::catat('LOGIN_GAGAL', 'users', null, 'Username dicoba: ' . $input['username']);

            return back()
                ->withErrors(['username' => 'Username atau password salah, atau akun nonaktif.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->user()->update(['last_login' => now()]);
        Audit::catat('LOGIN', 'users', $request->user()->id, 'Login berhasil');

        $uid = $request->user()->id;
        app()->terminating(fn () => Backup::jalankan($uid));

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Audit::catat('LOGOUT', 'users', $request->user()->id, 'Logout');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}