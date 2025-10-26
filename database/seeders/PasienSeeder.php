<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pasien;
use App\Models\User;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $doctors = User::where('role', 'dokter')->whereNotNull('poli_id')->get();
        
        foreach ($doctors as $doctor) {
            for ($i = 1; $i <= 5; $i++) {
                $gender = $faker->randomElement(['L', 'P']);
                
                Pasien::create([
                    'nama' => $faker->name($gender == 'L' ? 'male' : 'female'),
                    'tgl_lahir' => $faker->date('Y-m-d', '-10 years'),
                    'no_bpjs' => $faker->optional(0.7)->numerify('##########'),
                    'alamat' => $faker->address(),
                    'jk' => $gender,
                ]);
            }
        }
    }
}
