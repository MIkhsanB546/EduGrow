<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materiList = Materi::with(['guru', 'jenjang', 'kategori', 'quiz'])
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('student.materi.index', compact('materiList'));
    }

    public function show(Materi $materi)
    {
        $materi->load(['guru', 'jenjang', 'kategori', 'quiz']);

        return view('student.materi.show', compact('materi'));
    }
}
