<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentStudentRequest extends Model
{
    protected $table = 'parent_student_requests';

    protected $fillable = [
        'id_orang_tua',
        'id_siswa',
        'status',
    ];

    public function orangTua()
    {
        return $this->belongsTo(User::class, 'id_orang_tua');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa');
    }
}
