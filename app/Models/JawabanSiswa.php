<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';

    protected $primaryKey = 'id_jawaban_siswa';

    protected $fillable = [
        'id_quiz_attempt',
        'id_soal',
        'id_pilihan_jawaban',
        'is_correct',
    ];


    public function quizAttempt()
    {
        return $this->belongsTo(
            QuizAttempt::class,
            'id_quiz_attempt'
        );
    }


    public function soal()
    {
        return $this->belongsTo(
            Soal::class,
            'id_soal'
        );
    }


    public function pilihanJawaban()
    {
        return $this->belongsTo(
            PilihanJawaban::class,
            'id_pilihan_jawaban'
        );
    }
}
