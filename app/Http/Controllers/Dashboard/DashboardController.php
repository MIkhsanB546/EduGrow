<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $isGuru = auth()->user()->role === 'guru';

        if ($isGuru) {
            $idGuru = auth()->id();
            $jumlahMateri = Materi::where('id_guru', $idGuru)->count();
            $jumlahQuiz = Quiz::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))->count();
        } else {
            $jumlahMateri = Materi::count();
            $jumlahQuiz = Quiz::count();
        }

        $jumlahSiswa = User::siswa()->count();

        $latestMateri = Materi::with(['guru', 'jenjang', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        $latestQuiz = Quiz::with('materi')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'jumlahMateri',
            'jumlahQuiz',
            'jumlahSiswa',
            'latestMateri',
            'latestQuiz',
        ));
    }
}
