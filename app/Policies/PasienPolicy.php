<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasienPolicy
{
    use HandlesAuthorization;

    /**
     * Izinkan rekam medis untuk melihat semua.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'rekam_medis') {
            return true;
        }
    }

    /**
     * Siapa yang boleh melihat daftar pasien.
     */
    public function viewAny(User $user): bool
    {
        // Hanya loket dan rekam medis yang boleh lihat list pasien
        return in_array($user->role, ['loket', 'rekam_medis']);
    }

    /**
     * Siapa yang boleh melihat detail satu pasien.
     */
    public function view(User $user, Pasien $pasien): bool
    {
        return in_array($user->role, ['loket', 'rekam_medis']);
    }

    /**
     * Siapa yang boleh membuat data pasien baru.
     */
    public function create(User $user): bool
    {
        // Hanya loket yang boleh nambahin pasien baru
        return $user->role === 'loket';
    }

    /**
     * Siapa yang boleh mengedit data pasien.
     */
    public function update(User $user, Pasien $pasien): bool
    {
        // Hanya loket yang boleh ngedit
        return $user->role === 'loket';
    }

    /**
     * Siapa yang boleh menghapus data pasien.
     */
    public function delete(User $user, Pasien $pasien): bool
    {
        // Hanya loket yang boleh hapus
        return $user->role === 'loket';
    }
}

