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

            
            $table->text('s_keperawatan')->nullable();


            $table->json('riwayat_kesehatan')->nullable();
            $table->string('riwayat_kesehatan_lainnya')->nullable();
            $table->json('kebiasaan')->nullable();

            // Alergi
            $table->boolean('punya_alergi')->default(false);
            $table->string('alergi_keterangan')->nullable();

            // Status Psikologis
            $table->json('status_psikologis')->nullable(); // ['tenang', 'cemas', etc.]

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
            $table->boolean('punya_nyeri')->default(false);
            $table->integer('skor_nyeri')->nullable();

            // Status Fungsional
            $table->string('status_fungsional')->nullable(); // Mandiri, Perlu Bantuan, Ketergantungan total

            // Risiko Jatuh
            $table->boolean('risiko_jatuh_berjalan_tidak_seimbang')->nullable();
            $table->boolean('risiko_jatuh_menopang_saat_duduk')->nullable();
            $table->string('risiko_jatuh_hasil')->nullable(); // Tidak Berisiko, Risiko Rendah, Risiko Tinggi
            
            // A & P Keperawatan
            $table->text('a_keperawatan')->nullable()->comment('Assessment Keperawatan');
            $table->text('p_keperawatan')->nullable()->comment('Planning Keperawatan');

            // === ASESMEN MEDIS (BAGIAN YANG BERBEDA) ===
            $table->text('s_medis_anamnesis')->nullable();
            // $table->text('o_medis_objektif')->nullable();
            // KHUSUS GIGI
            $table->json('odontogram')->nullable();
            // UMUM & GIGI
            $table->text('a_medis_assessment')->nullable();
            $table->string('icd_x')->nullable();
            $table->text('p_medis_planning')->nullable();

            // === RENCANA TINDAK LANJUT (BAGIAN YANG SAMA) ===
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
