<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;

/**
 * Policy untuk otorisasi akses quiz.
 */
class QuizPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat daftar quiz.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat melihat detail quiz.
     */
    public function view(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $quiz->materi->id_guru === $user->id_user;
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat membuat quiz baru.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    /**
     * Menentukan apakah pengguna dapat mengubah quiz.
     */
    public function update(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $quiz->materi->id_guru === $user->id_user;
    }

    /**
     * Menentukan apakah pengguna dapat menghapus quiz.
     */
    public function delete(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $quiz->materi->id_guru === $user->id_user;
    }
}
