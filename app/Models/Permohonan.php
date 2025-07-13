<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Permohonan extends Model
{
    protected $table = 'permohonan';
    protected $fillable = [
        'id_penduduk',
        'id_surat',
        'kode_surat',
        'nomor_surat',
        'data',
        'status',
        'signature',
        'whatsapp_number',
        'pdf_path',
        'archive'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_surat)) {
                $model->kode_surat = $model->generateKodeSurat();
            }
        });
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }

    /**
     * Generate kode surat unik dengan format #[alphanumeric]
     * Contoh: #sda7h4huda8, #ab3x9k2mno1
     */
    public function generateKodeSurat()
    {
        do {
            // Metode 1: Menggunakan kombinasi huruf kecil dan angka (10 karakter)
            $kodeSurat = '#' . Str::lower(Str::random(10));

            // Metode 2: Alternatif dengan pola yang lebih mirip contoh Anda
            // $kodeSurat = '#' . $this->generateMixedString(11);

            // Metode 3: Menggunakan hash dari timestamp dan random
            // $kodeSurat = '#' . substr(md5(microtime() . mt_rand()), 0, 11);

        } while (self::where('kode_surat', $kodeSurat)->exists());

        return $kodeSurat;
    }

    /**
     * Generate string campuran huruf kecil dan angka dengan pola lebih natural
     */
    private function generateMixedString($length = 11)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            // Buat pola yang lebih natural: lebih banyak huruf di awal, angka di tengah/akhir
            if ($i < 3 || ($i > 6 && $i < 9)) {
                // Prioritas huruf untuk posisi awal dan akhir
                $chars = 'abcdefghijklmnopqrstuvwxyz';
            } else {
                // Campuran huruf dan angka untuk posisi tengah
                $chars = $characters;
            }

            $result .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $result;
    }

    public function generateNomorSurat()
    {
        // Ambil kode surat dari relasi surat (tidak digunakan dalam format baru)
        $kodeSurat = $this->surat->kode;

        // Format nomor surat: 145/001/03.2005-WK/I/2025
        $nomorAwal = 768;
        $urutanId = sprintf('%03d', $this->id); // Padding tiga digit, misalnya 001, 002
        $kodeWilayah = '03.2005-WK'; // Kode wilayah tetap sesuai contoh
        $bulanRomawi = $this->getRomanMonth(now()->month); // Konversi bulan ke angka Romawi
        $tahun = now()->year;

        // Buat nomor surat sesuai format baru
        $nomorSurat = sprintf('%d/%s/%s/%s/%d', $nomorAwal, $urutanId, $kodeWilayah, $bulanRomawi, $tahun);

        // Simpan nomor surat ke kolom nomor_surat
        $this->nomor_surat = $nomorSurat;
        $this->save();


        // Generate kode surat unik berupa angka acak 12 digit yang tidak akan pernah sama
        do {
            $uniqueKodeSurat = mt_rand(100000000000, 999999999999); // 12 digit numeric
        } while (self::where('kode_surat', $uniqueKodeSurat)->exists());

        $this->kode_surat = $uniqueKodeSurat;
        $this->save();


        return $nomorSurat;
    }

    protected function getRomanMonth($month)
    {
        $romanNumerals = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $romanNumerals[$month] ?? 'I'; // Default ke 'I' jika bulan tidak valid
    }

    // Metode statis diperbarui
    public static function generateNewNomorSurat($idSurat, $id)
    {
        $surat = Surat::findOrFail($idSurat); // Ambil data surat berdasarkan id_surat
        $nomorAwal = 145;
        $urutanId = sprintf('%03d', $id); // Padding tiga digit untuk id
        $kodeWilayah = '03.2005-WK'; // Kode wilayah tetap
        $bulanRomawi = (new self)->getRomanMonth(now()->month); // Gunakan instance untuk getRomanMonth
        $tahun = now()->year;

        return sprintf('%d/%s/%s/%s/%d', $nomorAwal, $urutanId, $kodeWilayah, $bulanRomawi, $tahun);
    }
}
