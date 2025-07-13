<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique(); // Nomor Induk Kependudukan
            $table->string('nama_lengkap', 100); // Nama lengkap
            $table->string('tempat_lahir', 50); // Tempat lahir
            $table->date('tanggal_lahir'); // Tanggal lahir
            $table->string('jenis_kelamin', 1); // Laki-laki (L) atau Perempuan (P)
            $table->string('alamat', 255); // Alamat lengkap
            $table->string('rt', 3); // Nomor RT
            $table->string('rw', 3); // Nomor RW
            $table->string('dusun');
            $table->string('agama', 20); // Agama
            $table->string('status_perkawinan', 20); // Status perkawinan
            $table->string('pekerjaan', 50)->nullable(); // Pekerjaan
            $table->string('no_kk', 16)->nullable(); // Nomor Kartu Keluarga
            $table->string('email', 100)->unique(); // Email untuk login
            $table->string('password'); // Password untuk login
            $table->enum('status', ['aktif', 'pindah', 'meninggal'])->default('aktif'); // Status penduduk
            $table->index('nik'); // Indeks untuk pencarian cepat
            $table->index('email'); // Indeks untuk login

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
