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
        Schema::create('catatan_perkembangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('User yang membuat catatan (PPA)');
            $table->text('hasil_pemeriksaan')->comment('Hasil Pemeriksaan, Analisis, Rencana (Format SOAP)');
            $table->text('instruksi_ppa')->comment('Instruksi Profesional Pemberi Asuhan');
            $table->timestamps(); // Ini akan otomatis mencatat Tanggal & Jam
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_perkembangans');
    }
};
