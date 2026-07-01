<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk autentikasi pengguna (login & logout).
 */
class AuthController extends Controller
{
    /**
     * Memproses login pengguna.
     * Mengarahkan ke dashboard atau halaman siswa sesuai role.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'admin', 'guru' => redirect()->intended('/dashboard'),
                'siswa' => redirect()->intended('/siswa'),
                default => redirect()->intended('/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => trans('auth.failed'),
        ])->onlyInput('email');
    }

    /**
     * Memproses logout dan invalidasi session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
