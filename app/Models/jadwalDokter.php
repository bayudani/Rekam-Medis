<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jadwalDokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Setiap jadwal dimiliki oleh satu dokter (User).
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
