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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->unique()->constrained('pendaftarans')->onDelete('cascade');

            // === BAGIAN KANAN ATAS (YANG KURANG KEMARIN) ===
            $table->json('cara_datang')->nullable(); // Checkbox: Sendiri, Diantar Polisi, dll
            $table->date('tanggal_datang')->nullable();
            $table->time('jam_datang')->nullable();
            $table->time('jam_diperiksa')->nullable();
            $table->time('jam_doa')->nullable();
            $table->boolean('DOA')->default(false)->comment('Dead on Arrival');
            $table->text('riwayat_alergi')->nullable();
            $table->json('penanggung_jawab_biaya')->nullable(); // Checkbox: BPJS, Umum, dll
            $table->json('tanda_kehidupan_negatif')->nullable(); // Checkbox: Denyut Nadi (-), Respirasi (-)

            $table->text("riwayat_penyakit_dahulu")->nullable();
            $table->string("keluhan_utama")->nullable();
            $table->boolean("trauma")->default(false);
            $table->string('kondisi')->nullable(); // Radio: Gawat Darurat, Darurat, dll

            // Initial Assessment
            $table->string('pupil')->nullable(); // isokhor / anisokhor
            $table->json('pemeriksaan_awal')->nullable(); // Checkbox: Airway & C, Breathing, dll
            // $table->string('gcs_awal')->nullable();
            $table->integer('gcs_e')->nullable()->comment('GCS Eye'); // Nilai Eye (1-4)
            $table->integer('gcs_v')->nullable()->comment('GCS Verbal');      // Nilai Verbal (1-5)
            $table->integer('gcs_m')->nullable()->comment('GCS Motorik'); // Nilai Motorik (1-6)
            $table->string('refleks_cahaya')->nullable();

            // Triase Primer
            $table->json('resusitasi')->nullable(); // Checkbox: Sumbatan, Henti Napas, dll
            $table->json('emergency')->nullable(); // Checkbox: Bebas, Ancaman, dll

            // Triase Sekunder
            $table->json('urgent')->nullable(); // Checkbox: Normal, Mengi, Takipnoe, dll
            $table->json('non_urgent')->nullable(); // Checkbox: Normal, Nadi Kuat, dll
            $table->json('false_emergency')->nullable(); // Checkbox: Normal, Nadi Kuat, dll

            // Tanda Vital & Keadaan Umum
            $table->string('kesadaran')->nullable();
            $table->string('td')->nullable()->comment('Tekanan Darah');
            $table->string('hr')->nullable()->comment('Heart Rate');
            $table->string('rr')->nullable()->comment('Respiratory Rate');
            $table->string('t')->nullable()->comment('Suhu Tubuh');
            $table->string('bb')->nullable()->comment('Berat Badan');
            $table->string('tb')->nullable()->comment('Tinggi Badan');
            $table->boolean('ada_keluhan_nyeri')->default(false);
            $table->integer('skor_nyeri')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
