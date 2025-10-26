<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Pasien;

class PendaftaranSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = Poli::all();
        $pasiens = Pasien::all();

        if ($pasiens->isEmpty()) {
            $this->command->warn('No patients found. Please run PasienSeeder first.');
            return;
        }

        foreach ($polis as $poli) {
            foreach ($pasiens as $pasien) {
                Pendaftaran::create([
                    'pasien_id' => $pasien->id,
                    'poli_id' => $poli->id,
                ]);
            }
        }
    }
}
