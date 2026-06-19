<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $table = 'quiz';

    protected $primaryKey = 'id_quiz';

    protected $fillable = [
        'materi_id',
        'judul',
        'deskripsi',
        'durasi_menit',
    ];

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id_materi');
    }

    public function soals(): HasMany
    {
        return $this->hasMany(Soal::class, 'quiz_id', 'id_quiz');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_id', 'id_quiz');
    }
}
