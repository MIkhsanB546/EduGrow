<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model jenjang pendidikan (SD, SMP, SMA).
 */
class Jenjang extends Model
{
    use HasFactory;

    protected $table = 'jenjang';

    protected $primaryKey = 'id_jenjang';

    protected $fillable = [
        'nama_jenjang'
    ];

    /**
     * Relasi ke materi yang termasuk dalam jenjang ini.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_jenjang');
    }
}
