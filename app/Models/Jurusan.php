<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    // ini untuk mengirim kan hasil inputan dari filament\jurusan di kirim ke database 
    protected $fillable = [
        'name',
    ];
}
