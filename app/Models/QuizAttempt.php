<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model percobaan quiz oleh siswa.
 */
class QuizAttempt extends Model
{
    use HasFactory;

    protected $table = 'quiz_attempts';

    protected $primaryKey = 'id_quiz_attempt';

    protected $fillable = [
        'id_siswa',
        'id_quiz',
        'skor_persen',
        'bintang',
        'tanggal_pengerjaan',
        'attempt_ke',
    ];

    /**
     * Relasi ke siswa yang mengerjakan quiz.
     */
    public function siswa()
    {
        return $this->belongsTo(
            User::class,
            'id_siswa'
        );
    }

    /**
     * Relasi ke quiz yang dikerjakan.
     */
    public function quiz()
    {
        return $this->belongsTo(
            Quiz::class,
            'id_quiz'
        );
    }

    /**
     * Relasi ke jawaban siswa pada percobaan ini.
     */
    public function jawabanSiswa()
    {
        return $this->hasMany(
            JawabanSiswa::class,
            'id_quiz_attempt'
        );
    }
}
