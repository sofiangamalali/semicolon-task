<?php

namespace App\Services;

use App\Interfaces\GroupRepoInterface;

class GroupService
{
    public function __construct(private GroupRepoInterface $groupRepo)
    {
    }
    
    public function getAll($filters = [], $perPage = 15)
    {
        return $this->groupRepo->getAll($filters, $perPage);
    }
    
    public function findById($id)
    {
        return $this->groupRepo->findById($id);
    }
    
    public function create(array $data)
    {
        return $this->groupRepo->create($data);
    }
    
    public function update($id, array $data)
    {
        return $this->groupRepo->update($id, $data);
    }
    
    public function delete($id)
    {
        return $this->groupRepo->delete($id);
    }
    
    public function assignPermissions($groupId, array $permissionIds)
    {
        return $this->groupRepo->assignPermissions($groupId, $permissionIds);
    }
    
    public function removePermissions($groupId, array $permissionIds)
    {
        return $this->groupRepo->removePermissions($groupId, $permissionIds);
    }
}