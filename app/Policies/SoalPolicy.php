<?php

namespace App\Policies;

use App\Models\Soal;
use App\Models\User;

/**
 * Policy untuk otorisasi akses soal.
 */
class SoalPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat daftar soal.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat melihat detail soal.
     */
    public function view(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $soal->quiz->materi->id_guru === $user->id_user;
        return false;
    }

    /**
     * Menentukan apakah pengguna dapat membuat soal baru.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    /**
     * Menentukan apakah pengguna dapat mengubah soal.
     */
    public function update(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $soal->quiz->materi->id_guru === $user->id_user;
    }

    /**
     * Menentukan apakah pengguna dapat menghapus soal.
     */
    public function delete(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $soal->quiz->materi->id_guru === $user->id_user;
    }
}
