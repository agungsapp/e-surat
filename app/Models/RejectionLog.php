<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectionLog extends Model
{
    protected $table = 'rejection_log';
    protected $fillable = [
        'id_permohonan',
        'alasan',
        'type',
    ];
}
