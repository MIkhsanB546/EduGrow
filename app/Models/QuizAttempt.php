<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $primaryKey = 'id_quiz_attempt';

    protected $fillable = [
        'student_id',
        'quiz_id',
        'skor_persen',
        'bintang',
        'tanggal_pengerjaan',
    ];

    protected $casts = [
        'skor_persen' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id_user');
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id_quiz');
    }

    public function jawabanSiswas(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class, 'attempt_id', 'id_quiz_attempt');
    }
}
