<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSoalRequest;
use App\Models\Soal;
use App\Models\Quiz;
use App\Models\PilihanJawaban;

/**
 * Controller untuk mengelola soal dalam quiz.
 */
class SoalController extends Controller
{
    /**
     * Menampilkan daftar soal dalam quiz.
     */
    public function index(Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        $quiz->load('soal.pilihanJawaban');
        return view('dashboard.soal.index', compact('quiz'));
    }

    /**
     * Menampilkan form tambah soal.
     */
    public function create(Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        return view('dashboard.soal.create', compact('quiz'));
    }

    /**
     * Menyimpan soal beserta pilihan jawaban.
     */
    public function store(StoreSoalRequest $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $data = $request->validated();

        $soal = Soal::create([
            'id_quiz' => $quiz->id_quiz,
            'pertanyaan' => $data['pertanyaan'],
        ]);

        $jawabanBenarIndex = (int) $data['jawaban_benar'];

        // Simpan setiap pilihan jawaban
        foreach ($data['pilihan_jawaban'] as $index => $pilihan) {
            PilihanJawaban::create([
                'id_soal' => $soal->id_soal,
                'jawaban' => $pilihan['jawaban'],
                'is_correct' => $index === $jawabanBenarIndex,
            ]);
        }

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit soal.
     */
    public function edit(Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);
        $soal->load('pilihanJawaban');
        return view('dashboard.soal.edit', compact('quiz', 'soal'));
    }

    /**
     * Memperbarui soal dan pilihan jawaban.
     */
    public function update(StoreSoalRequest $request, Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);

        $data = $request->validated();

        $soal->update([
            'pertanyaan' => $data['pertanyaan'],
        ]);

        // Hapus pilihan lama dan buat baru
        $soal->pilihanJawaban()->delete();

        $jawabanBenarIndex = (int) $data['jawaban_benar'];

        foreach ($data['pilihan_jawaban'] as $index => $pilihan) {
            PilihanJawaban::create([
                'id_soal' => $soal->id_soal,
                'jawaban' => $pilihan['jawaban'],
                'is_correct' => $index === $jawabanBenarIndex,
            ]);
        }

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Menghapus soal.
     */
    public function destroy(Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);
        $soal->delete();

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
