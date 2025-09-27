<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;

class GroupPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermission('view_groups');
    }
    
    public function view(User $user, Group $group)
    {
        return $user->hasPermission('view_groups');
    }
    
    public function create(User $user)
    {
        return $user->hasPermission('create_groups');
    }
    
    public function update(User $user, Group $group)
    {
        return $user->hasPermission('update_groups');
    }
    
    public function delete(User $user, Group $group)
    {
        return $user->hasPermission('delete_groups');
    }
    
    public function assignPermissions(User $user, Group $group)
    {
        return $user->hasPermission('assign_permissions_to_groups');
    }
}