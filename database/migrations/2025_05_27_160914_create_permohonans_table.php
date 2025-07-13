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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penduduk')->nullable()->constrained('penduduk');
            $table->foreignId('id_surat')->constrained('surat')->onDelete('cascade');
            $table->string('kode_surat')->nullable(); // Kode surat, jika diperlukan
            $table->string('nomor_surat')->nullable();
            $table->json('data');
            $table->string('status')->default('pending');
            $table->string('signature')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('whatsapp_number')->nullable(); // Nomor WhatsApp penduduk
            $table->boolean('archive')->default(false); // Soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
