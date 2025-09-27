<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepoInterface;

class UserRepo implements UserRepoInterface
{
    public function getAll($filters = [], $perPage = 15)
    {
        $query = User::with(['groups.permissions']);
        foreach ($filters as $field => $value) {
            $query->where($field, 'like', "%$value%");
        }
        return $query->paginate($perPage);
    }
    public function findById($id)
    {
        return User::with('groups.permissions')->find($id);
    }
    public function create(array $data)
    {
        return User::create($data);
    }
    public function update($id, array $data)
    {
        return User::where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
    public function assignToGroups($userId, array $groupIds)
    {
        $user = $this->findById($userId);
        return $user->groups()->sync($groupIds, false);
    }
    public function removeFromGroups($userId, array $groupIds)
    {
        $user = $this->findById($userId);
        return $user->groups()->detach($groupIds);
    }
}