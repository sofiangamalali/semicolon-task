<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('view_users');
    }

    public function view(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id || $user->hasPermission('view_users');
    }

    public function create(User $user)
    {
        return $user->hasPermission('create_users');
    }
    public function update(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id || $user->hasPermission('update_users');
    }

    public function delete(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id && $user->hasPermission('delete_users');
    }

    public function assignGroups(User $user, User $targetUser)
    {
        return $user->hasPermission('assign_users_to_groups');
    }
}
