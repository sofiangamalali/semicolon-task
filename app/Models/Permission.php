<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_permissions');
    }

    public function users()
    {
        return User::whereHas('groups.permissions', function ($query) {
            $query->where('permissions.id', $this->id);
        });
    }
}