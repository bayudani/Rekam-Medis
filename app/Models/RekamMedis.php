<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekamMedis extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rekam_medis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pendaftaran_id',
        'cara_datang',
        'tanggal_datang',
        'jam_datang',
        'jam_diperiksa',
        'DOA',
        'jam_doa',
        'riwayat_alergi',
        'penanggung_jawab_biaya',
        'tanda_kehidupan_negatif',
        'riwayat_penyakit_dahulu',
        'keluhan_utama',
        'trauma',
        'kondisi',
        'pupil',
        'pemeriksaan_awal',
        'gcs_e',
        'gcs_v',
        'gcs_m',
        'refleks_cahaya',
        'resusitasi',
        'emergency',
        'urgent',
        'non_urgent',
        'false_emergency',
        'kesadaran',
        'td',
        'hr',
        'rr',
        't',
        'bb',
        'tb',
        'ada_keluhan_nyeri',
        'skor_nyeri',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cara_datang' => 'array',
            'penanggung_jawab_biaya' => 'array',
            'tanda_kehidupan_negatif' => 'array',
            'pemeriksaan_awal' => 'array',
            'resusitasi' => 'array',
            'emergency' => 'array',
            'urgent' => 'array',
            'non_urgent' => 'array',
            'false_emergency' => 'array',
        ];
    }

    /**
     * Setiap rekam medis dimiliki oleh satu Pendaftaran.
     */
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
