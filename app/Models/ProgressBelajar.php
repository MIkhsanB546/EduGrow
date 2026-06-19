<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressBelajar extends Model
{
    protected $table = 'progress_belajar';

    protected $primaryKey = 'id_progress_belajar';

    protected $fillable = [
        'student_id',
        'materi_id',
        'status',
        'progress_persen',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id_user');
    }

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id_materi');
    }
}
