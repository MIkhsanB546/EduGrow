<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model quiz (kuis) yang terkait dengan materi.
 */
class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $primaryKey = 'id_quiz';

    protected $fillable = [
        'id_materi',
        'judul',
        'deskripsi',
        'durasi_menit',
    ];

    /**
     * Relasi ke materi tempat quiz berada.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }

    /**
     * Relasi ke daftar soal dalam quiz.
     */
    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_quiz');
    }

    /**
     * Relasi ke percobaan quiz oleh siswa.
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'id_quiz');
    }
}
