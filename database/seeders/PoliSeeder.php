<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            ['nama_poli' => 'Poli Umum'],
            ['nama_poli' => 'Poli Gigi'],
            ['nama_poli' => 'Poli KIA'],
            ['nama_poli' => 'Poli MTBS'],
            ['nama_poli' => 'Poli Gizi'],
            ['nama_poli' => 'Poli Lansia'],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
