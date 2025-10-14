<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanPerkembangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'user_id',
        'hasil_pemeriksaan',
        'instruksi_ppa',
    ];

    /**
     * Setiap catatan dimiliki oleh satu Pendaftaran.
     */
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    /**
     * Setiap catatan dibuat oleh satu User (PPA).
     */
    public function ppa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
