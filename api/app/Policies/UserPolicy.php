<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // Verifica se o usuário pode atualizar outro usuário
    public function update(User $authenticatedUser, User $targetUser)
    {
        return (int) $authenticatedUser->id === (int) $targetUser->id;
    }
    // Verifica se o usuário pode deletar outro usuário
    public function delete(User $authenticatedUser, User $targetUser)
    {
        return $authenticatedUser->id === $targetUser->id;
    }
}
