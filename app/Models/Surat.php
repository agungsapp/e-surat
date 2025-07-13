<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $fillable = ['nama', 'kode', 'deskripsi', 'active', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
