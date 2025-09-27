<?php

namespace App\Interfaces;

interface GroupRepoInterface
{
    public function getAll($filters = [], $perPage = 15);
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function assignPermissions($groupId, array $permissionIds);
    public function removePermissions($groupId, array $permissionIds);
}