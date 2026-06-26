<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model soal dalam quiz.
 */
class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_quiz',
        'pertanyaan'
    ];

    /**
     * Relasi ke quiz tempat soal berada.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }

    /**
     * Relasi ke daftar pilihan jawaban soal ini.
     */
    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_soal');
    }

    /**
     * Relasi ke jawaban siswa untuk soal ini.
     */
    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class, 'id_soal');
    }
}
