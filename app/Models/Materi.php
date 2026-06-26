<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model materi pembelajaran.
 */
class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_guru',
        'id_jenjang',
        'id_kategori_materi',
        'judul',
        'deskripsi',
        'file_materi',
        'thumbnail',
        'is_published',
    ];

    /**
     * Relasi ke guru pembuat materi.
     */
    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id_user');
    }

    /**
     * Relasi ke jenjang materi.
     */
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }

    /**
     * Relasi ke kategori materi.
     */
    public function kategori()
    {
        return $this->belongsTo(
            KategoriMateri::class,
            'id_kategori_materi'
        );
    }

    /**
     * Relasi ke quiz yang terkait dengan materi.
     */
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'id_materi');
    }
}
