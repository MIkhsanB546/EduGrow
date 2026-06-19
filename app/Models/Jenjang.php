<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenjang extends Model
{
    protected $table = 'jenjang';

    protected $primaryKey = 'id_jenjang';

    protected $fillable = [
        'nama_jenjang',
    ];

    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class, 'jenjang_id', 'id_jenjang');
    }
}
