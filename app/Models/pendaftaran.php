<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    // protected $table = 'pendaftarans';
    protected $fillable = [
        'pasien_id',
        'user_id',
        'poli_id',
        'tanggal_asesmen',
        'jam_asesmen',
        'hambatan_pelayanan',
        'status_sosial',
        's_keperawatan',
        'riwayat_kesehatan',
        'riwayat_kesehatan_lainnya',
        'kebiasaan',
        'punya_alergi',
        'alergi_keterangan',
        'status_psikologis',
        'o_keperawatan',
        'td',        
        'nadi',        
        'rr',        
        'suhu',        
        'tinggi_badan',        
        'berat_badan',        
        'lingkar_lengan',        
        'lingkar_leher',        
        'lingkar_pinggul',        
        'lingkar_dada',        
        'lingkar_tenggorok',        
        'lingkar_paha',        
        'lingkar_paha',        
        'lingkar_paha',        
        'lingkar_paha',        
        'lingkar_paha',
        'imt',
        'lila',
        's_medis_anamnesis',
        // 'o_medis_objektif',
        'odontogram',
        'diagnosa_medis',
        'tindakan_medis',
        'status',
        'dokter_id',
    ];
}
