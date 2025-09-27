<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepoInterface;
use App\Models\Permission;

class PermissionRepo implements PermissionRepoInterface
{
    public function getAll()
    {
        return Permission::get();
    }

}