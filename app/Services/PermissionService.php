<?php

namespace App\Services;

use App\Interfaces\PermissionRepoInterface;


class PermissionService
{


    public function __construct(private PermissionRepoInterface $permissionRepo)
    {


    }
    public function getAll()
    {
        return $this->permissionRepo->getAll();
    }

}