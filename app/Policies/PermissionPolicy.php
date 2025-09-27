<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('view_permissions');
    }
}
