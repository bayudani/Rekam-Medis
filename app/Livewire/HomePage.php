<?php

namespace App\Livewire;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Livewire\Component;

class HomePage extends Component
{
    /**
     * Menampung status operasional puskesmas (Buka/Tutup).
     *
     * @var string
     */
    public $statusOperasional;

    /**
     * Menampung pesan status yang akan ditampilkan di view.
     *
     * @var string
     */
    public $pesanStatus;

    /**
     * Method yang dijalankan saat komponen di-mount (inisialisasi).
     * Kita akan cek jam operasional di sini.
     */
    public function mount()
    {
        $this->cekJamOperasional();
    }

    /**
     * Fungsi untuk mengecek jam operasional Puskesmas secara dinamis.
     * Logic ini akan menentukan status Buka/Tutup berdasarkan hari dan jam saat ini.
     * Best practice: Logic bisnis seperti ini diletakkan di dalam component class,
     * bukan di dalam file Blade, agar view tetap bersih.
     */
    public function cekJamOperasional()
    {
        // Set timezone ke Waktu Indonesia Barat
        $now = CarbonCarbon::now('Asia/Jakarta');
        $dayOfWeek = $now->dayOfWeek; // 0 (Minggu) - 6 (Sabtu)
        $time = $now->format('H:i');

        $isBuka = false;

        // Senin - Jumat (1-5), jam 08:00 - 16:00
        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            if ($time >= '08:00' && $time < '16:00') {
                $isBuka = true;
            }
        }
        // Sabtu (6), jam 08:00 - 12:00
        elseif ($dayOfWeek == 6) {
            if ($time >= '08:00' && $time < '12:00') {
                $isBuka = true;
            }
        }

        if ($isBuka) {
            $this->statusOperasional = 'Buka';
            $this->pesanStatus = 'Kami siap melayani Anda sekarang.';
        } else {
            $this->statusOperasional = 'Tutup';
            $this->pesanStatus = 'Kami akan buka kembali sesuai jadwal.';
        }
    }

    /**
     * Method render untuk menampilkan view.
     * Livewire akan otomatis me-render file view yang sesuai.
     */
    public function render()
    {
        return view('livewire.home-page');
    }
}
