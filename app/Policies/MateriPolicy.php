<?php

namespace App\Policies;

use App\Models\Materi;
use App\Models\User;

/**
 * Policy untuk otorisasi akses materi.
 */
class MateriPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat daftar materi.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat melihat detail materi.
     * Admin: semua, Guru: miliknya sendiri, Siswa: yang dipublikasikan.
     */
    public function view(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $materi->id_guru === $user->id_user;
        return $materi->is_published;
    }

    /**
     * Menentukan apakah pengguna dapat membuat materi baru.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    /**
     * Menentukan apakah pengguna dapat mengubah materi.
     */
    public function update(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $materi->id_guru === $user->id_user;
    }

    /**
     * Menentukan apakah pengguna dapat menghapus materi.
     */
    public function delete(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $materi->id_guru === $user->id_user;
    }
}
