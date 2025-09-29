<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class pasien extends Model
{
    protected $table = 'pasiens';
    protected $fillable = ['nama', 'tgl_lahir', 'no_rm', 'no_bpjs', 'alamat', 'jk'];
    

   /**
     * Setiap Pasien bisa memiliki banyak Pendaftaran.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

     /**
     * Boot the model.
     * * Method ini bakal jalan otomatis setiap kali ada event di model ini.
     * Kita pake event 'creating' untuk generate no_rm sebelum data disimpan.
     */
    protected static function booted(): void
    {
        static::creating(function (Pasien $pasien) {
            // Cek dulu apakah no_rm sudah diisi manual atau belum
            if (empty($pasien->no_rm)) {
                // 1. Ambil pasien terakhir yang dibuat untuk mendapatkan ID terakhir.
                $lastPasien = static::latest('id')->first();
                $lastId = $lastPasien ? $lastPasien->id : 0;
                
                // 2. Buat nomor berikutnya.
                $nextId = $lastId + 1;
                
                // 3. Format nomornya jadi 3 digit (e.g., 001, 015, 123)
                $formattedId = str_pad($nextId, 3, '0', STR_PAD_LEFT);
                
                // 4. Gabungkan dengan prefix dan set ke atribut no_rm.
                $pasien->no_rm = 'RM-' . $formattedId;
            }
        });
    }
}
