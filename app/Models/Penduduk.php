<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'no_kk',
        'email',
        'password',
        'status'
    ];

    protected $hidden = [
        'password', // Sembunyikan password dari hasil query
    ];

    public function getRouteKeyName()
    {
        return 'nik'; // Gunakan NIK sebagai kunci rute
    }

    public function permohonan(): HasMany
    {
        return $this->hasMany(Permohonan::class, 'id_penduduk');
    }
}
