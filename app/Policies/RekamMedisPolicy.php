<?php

namespace App\Policies;

use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RekamMedisPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Izinkan dokter untuk melihat daftar rekam medis
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RekamMedis $rekamMedis): bool
    {
        // Izinkan dokter untuk melihat detail rekam medis
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Izinkan dokter untuk membuat rekam medis baru
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RekamMedis $rekamMedis): bool
    {
        // Izinkan dokter untuk mengupdate rekam medis
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RekamMedis $rekamMedis): bool
    {
        // Izinkan dokter untuk menghapus rekam medis
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RekamMedis $rekamMedis): bool
    {
        return $user->role === 'dokter';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RekamMedis $rekamMedis): bool
    {
        return $user->role === 'dokter';
    }
}