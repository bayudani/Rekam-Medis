<?php

namespace App\Livewire\Puskesmas;

use Livewire\Component;

class Kontak extends Component
{
    public $nama = '';
    public $email = '';
    public $pesan = '';

    /**
     * Fungsi untuk handle pengiriman form kontak.
     * Untuk saat ini, hanya menampilkan pesan sukses.
     */
    public function kirimPesan()
    {
        // Validasi input
        $this->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email',
            'pesan' => 'required|min:10',
        ]);

        // Logic untuk kirim email bisa ditambahkan di sini nanti

        // Reset form
        $this->reset();

        // Kirim pesan sukses ke session
        session()->flash('sukses', 'Pesan Anda telah berhasil terkirim! Terima kasih.');
    }
    public function render()
    {
        return view('livewire.puskesmas.kontak');
    }
}
