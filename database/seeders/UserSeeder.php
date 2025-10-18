<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Poli;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Poli
        $poliUmum = Poli::create(['nama_poli' => 'Poli Umum']);
        $poliGigi = Poli::create(['nama_poli' => 'Poli Gigi & Mulut']);
        $poliTindakan = Poli::create(['nama_poli' => 'Ruang Tindakan']); 

       

        // Create Users
        User::factory()->create([
            'name' => 'Petugas Loket',
            'email' => 'loket@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'loket',
        ]);

        User::factory()->create([
            'name' => 'Admin Rekam Medis',
            'email' => 'rekammedis@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'rekam_medis',
        ]);

        User::factory()->create([
            'name' => 'Dr. Budi (Umum)',
            'email' => 'dokter.umum@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'poli_id' => $poliUmum->id,
        ]);


        User::factory()->create([
            'name' => 'Drg. Siti (Gigi)',
            'email' => 'dokter.gigi@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'poli_id' => $poliGigi->id,
        ]);

        User::factory()->create([
            'name' => 'Dr. Sarah (Tindakan)',
            'email' => 'dokter.tindakan@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
            'poli_id' => $poliTindakan->id,
        ]);

        User::factory()->create([
            'name' => 'Apoteker Ani',
            'email' => 'apoteker@puskesmas.com',
            'password' => Hash::make('password'),
            'role' => 'apoteker',
        ]);
    }
}
