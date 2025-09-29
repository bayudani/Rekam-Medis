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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            $table->foreignId('dokter_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('Menunggu'); // Menunggu, Diperiksa, Selesai
            $table->timestamps();
            $table->date('tanggal_asesmen')->nullable();
            $table->time('jam_asesmen')->nullable();
            $table->json('hambatan_pelayanan')->nullable();
            $table->string('status_sosial')->nullable();

            //S keperawatan
            $table->json('riwayat_kesehatan')->nullable();
            $table->string('riwayat_kesehatan_lainnya')->nullable();
            $table->json('kebiasaan')->nullable();

            $table->boolean('ada_alergi')->default(false);
            $table->string('alergi_keterangan')->nullable();
            // Status Psikologis
            $table->json('status_psikologis')->nullable(); // ['tenang', 'cemas', etc.]
            // end s keperawatan

            // O (Objektif Keperawatan)
            $table->text('o_keperawatan')->nullable();
            // Tanda-Tanda Vital (TTV)
            $table->string('td')->nullable()->comment('Tekanan Darah');
            $table->string('rr')->nullable()->comment('Respiratory Rate');
            $table->string('hr')->nullable()->comment('Heart Rate');
            $table->string('t')->nullable()->comment('Suhu Tubuh');
            $table->string('lingkar_perut')->nullable();
            $table->string('tb')->nullable()->comment('Tinggi Badan');
            $table->string('bb')->nullable()->comment('Berat Badan');
            $table->string('imt')->nullable()->comment('Indeks Massa Tubuh');
            $table->string('lingkar_kepala')->nullable();
            $table->string('lila')->nullable()->comment('Lingkar Lengan Atas');
            $table->string('spo2')->nullable()->comment('Saturasi Oksigen');
            // Skala Nyeri
            $table->boolean('skala_nyeri')->default(false);
            $table->integer('skor_nyeri')->nullable();
            // Status Fungsional
            $table->string('status_fungsional')->nullable(); // Mandiri, Perlu Bantuan, Ketergantungan total
            // end O keperawatan

            // Kolom Baru untuk Risiko Jatuh
            $table->boolean('risiko_jatuh_penilaian_1')->default(false)->comment('Cara berjalan pasien (tidak seimbang/alat bantu)');
            $table->boolean('risiko_jatuh_penilaian_2')->default(false)->comment('Menopang saat akan duduk');
            $table->string('risiko_jatuh_hasil')->nullable();

            $table->text('a_keperawatan')->nullable();
            $table->text('p_keperawatan')->nullable();

            // Asesmen Medis
            $table->text('anamnesis_medis')->nullable();
            $table->text('pemeriksaan_fisik_medis')->nullable(); //Khusus rawat jalan
            $table->text('pemeriksaan_penunjang_medis')->nullable(); //Khusus rawat jalan
            $table->string('laboratorium')->nullable(); //Khusus rawat jalan
            $table->json('odontogram')->nullable(); // KHUSUS GIGI
            $table->text('assessment_diagnosa_medis')->nullable();
            $table->string('icd_x')->nullable();
            $table->text('rencana_terapi_medis')->nullable();
            $table->json('rujuk_internal')->nullable();
            $table->json('rujuk_eksternal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
