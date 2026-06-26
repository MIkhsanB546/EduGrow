<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model kategori materi (Matematika, IPA, dll).
 */
class KategoriMateri extends Model
{
  use HasFactory;

  protected $table = 'kategori_materi';

  protected $primaryKey = 'id_kategori_materi';

  protected $fillable = [
    'nama_kategori',
    'deskripsi'
  ];

  /**
   * Relasi ke materi dalam kategori ini.
   */
  public function materi()
  {
    return $this->hasMany(Materi::class, 'id_kategori_materi');
  }
}
