<?php

namespace App\Repositories;

use App\Interfaces\GroupRepoInterface;
use App\Models\Group;

class GroupRepo implements GroupRepoInterface
{
    public function getAll($filters = [], $perPage = 15)
    {
        $query = Group::with(['users', 'permissions']);
        
        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }
        
        if (!empty($filters['description'])) {
            $query->where('description', 'like', "%{$filters['description']}%");
        }
        
        return $query->paginate($perPage);
    }
    
    public function findById($id)
    {
        return Group::with(['users', 'permissions'])->find($id);
    }
    
    public function create(array $data)
    {
        return Group::create($data);
    }
    
    public function update($id, array $data)
    {
        return Group::where('id', $id)->update($data);
    }
    
    public function delete($id)
    {
        return Group::destroy($id);
    }
    
    public function assignPermissions($groupId, array $permissionIds)
    {
        $group = $this->findById($groupId);
        return $group->permissions()->sync($permissionIds, false);
    }
    
    public function removePermissions($groupId, array $permissionIds)
    {
        $group = $this->findById($groupId);
        return $group->permissions()->detach($permissionIds);
    }
}