<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaId = auth()->id();

        $totalQuiz = Quiz::count();

        $attempts = QuizAttempt::where('id_siswa', $siswaId)->get();

        $completedQuiz = $attempts->count();
        $averageScore = round($attempts->avg('skor_persen') ?? 0, 1);
        $totalStars = (int) $attempts->sum('bintang');

        $overallProgress = $totalQuiz > 0
            ? round(($completedQuiz / $totalQuiz) * 100)
            : 0;

        $continueMateri = Materi::with('kategori')
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        $recentAttempts = QuizAttempt::where('id_siswa', $siswaId)
            ->with(['quiz.materi'])
            ->latest('tanggal_pengerjaan')
            ->take(5)
            ->get();

        return view('student.dashboard.index', compact(
            'overallProgress',
            'averageScore',
            'completedQuiz',
            'totalStars',
            'continueMateri',
            'recentAttempts',
        ));
    }
}
