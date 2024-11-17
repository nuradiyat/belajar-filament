<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{

    // untuk mengirim/memasukan hasil dari filamen/mahasiswa 
    protected $fillable = [
       'nim',
       'name',
       'jurusan_id'
    ];

    // agar sis mahasiswanini terbung dengan jurusan
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(jurusan::class);
    }
}
