<?php

namespace App\Policies;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PendaftaranPolicy
{
    use HandlesAuthorization;

    /**
     * Izinkan rekam medis untuk bypass semua aturan dan melihat semuanya.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'rekam_medis') {
            return true;
        }
    }

    /**
     * Siapa yang boleh melihat daftar pendaftaran.
     */
    public function viewAny(User $user): bool
    {
        // Semua role boleh liat daftar pendaftaran, nanti difilter lagi di query
        return in_array($user->role, ['loket', 'dokter', 'rekam_medis']);
    }

    /**
     * Siapa yang boleh melihat detail satu pendaftaran.
     */
    public function view(User $user, Pendaftaran $pendaftaran): bool
    {
        // Dokter hanya bisa liat pendaftaran di polinya sendiri
        if ($user->role === 'dokter') {
            return $user->poli_id === $pendaftaran->poli_id;
        }
        
        // Loket dan rekam medis boleh liat semua
        return in_array($user->role, ['loket', 'rekam_medis']);
    }

    /**
     * Siapa yang boleh membuat pendaftaran baru.
     */
    public function create(User $user): bool
    {
        // Hanya loket yang boleh mendaftarkan pasien
        return $user->role === 'loket';
    }

    /**
     * Siapa yang boleh mengedit pendaftaran (mengisi rekam medis).
     */
    public function update(User $user, Pendaftaran $pendaftaran): bool
    {
        // Hanya dokter dari poli yang bersangkutan yang boleh ngisi
        if ($user->role === 'dokter') {
            return $user->poli_id === $pendaftaran->poli_id;
        }
        // Loket juga bisa edit, misal ganti status atau dokter
        if ($user->role === 'loket') {
            return true;
        }

        return false;
    }

    /**
     * Siapa yang boleh menghapus pendaftaran.
     */
    public function delete(User $user, Pendaftaran $pendaftaran): bool
    {
        // Hanya loket yang boleh hapus
        return $user->role === 'loket';
    }
}

