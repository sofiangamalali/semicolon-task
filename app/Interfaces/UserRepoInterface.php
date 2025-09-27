<?php

namespace App\Interfaces;

interface UserRepoInterface
{
    public function getAll($filters = [], $perPage = 15);
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function assignToGroups($userId, array $groupIds);
    public function removeFromGroups($userId, array $groupIds);
}
