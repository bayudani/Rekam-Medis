<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dokter
        $dokterUmum = User::where('email', 'dokter.umum@puskesmas.com')->first();
        $dokterGigi = User::where('email', 'dokter.gigi@puskesmas.com')->first();

        // Jadwal untuk Dokter Umum
        if ($dokterUmum) {
            JadwalDokter::create([
                'user_id' => $dokterUmum->id,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '14:00:00',
            ]);
            JadwalDokter::create([
                'user_id' => $dokterUmum->id,
                'hari' => 'Rabu',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '14:00:00',
            ]);
        }

        // Jadwal untuk Dokter Gigi
        if ($dokterGigi) {
            JadwalDokter::create([
                'user_id' => $dokterGigi->id,
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '15:00:00',
            ]);
            JadwalDokter::create([
                'user_id' => $dokterGigi->id,
                'hari' => 'Kamis',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '15:00:00',
            ]);
        }
    }
}
