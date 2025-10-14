<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pasien_id',
        'poli_id',
        'dokter_id',
        'status',
        'tanggal_asesmen',
        'jam_asesmen',
        'hambatan_pelayanan',
        'status_sosial',
        'riwayat_kesehatan',
        'riwayat_kesehatan_lainnya',
        'kebiasaan',
        'ada_alergi',
        'alergi_keterangan',
        'status_psikologis',
        'o_keperawatan',
        'td',
        'rr',
        'hr',
        't',
        'lingkar_perut',
        'tb',
        'bb',
        'imt',
        'lingkar_kepala',
        'lila',
        'spo2',
        'skala_nyeri',
        'skor_nyeri',
        'status_fungsional',
        'risiko_jatuh_penilaian_1',
        'risiko_jatuh_penilaian_2',
        'risiko_jatuh_hasil',
        'a_keperawatan',
        'p_keperawatan',
        'anamnesis_medis',
        'pemeriksaan_fisik_medis',
        'pemeriksaan_penunjang_medis',
        'laboratorium',
        'odontogram',
        'assessment_diagnosa_medis',
        'icd_x',
        'rencana_terapi_medis',
        'rujuk_internal',
        'rujuk_eksternal',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hambatan_pelayanan' => 'array',
            'riwayat_kesehatan' => 'array',
            'kebiasaan' => 'array',
            'status_psikologis' => 'array',
            'odontogram' => 'array',
            'rujuk_internal' => 'array',
            'rujuk_eksternal' => 'array',
        ];
    }

    /**
     * Setiap pendaftaran dimiliki oleh satu Pasien.
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Setiap pendaftaran merujuk ke satu Poli.
     */
    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    /**
     * Setiap pendaftaran ditangani oleh satu Dokter (User).
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
    // rekamMedis
    public function rekamMedis(): HasOne
    {
        return $this->hasOne(RekamMedis::class);
    }
    public function catatanPerkembangans(): HasMany
    {
        return $this->hasMany(CatatanPerkembangan::class);
    }
}
