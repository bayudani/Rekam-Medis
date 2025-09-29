<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Hanya rekam medis yang bisa akses semua fitur user management.
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'rekam_medis') {
            return true;
        }
        return false; // Selain rekam medis, tidak boleh akses sama sekali.
    }

    public function viewAny(User $user): bool { return false; }
    public function view(User $user, User $model): bool { return false; }
    public function create(User $user): bool { return false; }
    public function update(User $user, User $model): bool { return false; }
    public function delete(User $user, User $model): bool { return false; }
}

