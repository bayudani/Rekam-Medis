<?php

namespace App\Livewire\Puskesmas;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class JadwalDokter extends Component
{
    public string $hariIni;
    public Collection $dokters;

    public function mount()
    {
        // Set locale ke Indonesia biar nama hari bener
        Carbon::setLocale('id');

        $this->hariIni = Carbon::now()->translatedFormat('l'); // Hasilnya: Selasa
        $jamSekarang = Carbon::now()->format('H:i:s');

        // Ambil semua user yang rolenya dokter
        // Eager load relasi poli & jadwal HARI INI SAJA biar query efisien
        $semuaDokter = User::where('role', 'dokter')
            ->with(['poli', 'jadwal' => function ($query) {
                $query->where('hari', $this->hariIni);
            }])
            ->get();

        // Proses data dokter untuk nentuin status
        $this->dokters = $semuaDokter->map(function ($dokter) use ($jamSekarang) {
            $jadwalHariIni = $dokter->jadwal->first(); // Ambil jadwal pertama hari ini

            if ($jadwalHariIni) {
                // Jika ada jadwal hari ini, cek jamnya
                if ($jamSekarang >= $jadwalHariIni->jam_mulai && $jamSekarang <= $jadwalHariIni->jam_selesai) {
                    $dokter->status = 'Aktif';
                } else {
                    $dokter->status = 'Selesai Praktek';
                }
                // Simpan detail jadwalnya
                $dokter->jadwal_aktif = $jadwalHariIni;
            } else {
                // Jika tidak ada jadwal sama sekali hari ini
                $dokter->status = 'Libur';
                $dokter->jadwal_aktif = null;
            }
            return $dokter;
        });
    }

    public function render()
    {
        return view('livewire.puskesmas.jadwal-dokter');
    }
}
