<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model pilihan jawaban pada setiap soal.
 */
class PilihanJawaban extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawaban';

    protected $primaryKey = 'id_pilihan_jawaban';

    protected $fillable = [
        'id_soal',
        'jawaban',
        'is_correct'
    ];

    /**
     * Relasi ke soal tempat pilihan ini berada.
     */
    public function soal()
    {
        return $this->belongsTo(
            Soal::class,
            'id_soal'
        );
    }

    /**
     * Relasi ke jawaban siswa yang memilih opsi ini.
     */
    public function jawabanSiswa()
    {
        return $this->hasMany(
            JawabanSiswa::class,
            'id_pilihan_jawaban'
        );
    }
}
