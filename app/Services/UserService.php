<?php

namespace App\Services;

use App\Interfaces\UserRepoInterface;
use App\Repositories\UserRepo;
use App\Traits\ImageTrait;
use Hash;

class UserService
{

    use ImageTrait;
    public function __construct(private UserRepoInterface $userRepo)
    {
    }
    public function getAll($filters = [], $perPage = 15)
    {
        return $this->userRepo->getAll($filters, $perPage);
    }


    public function findById($id)
    {
        return $this->userRepo->findById($id);
    }

    public function create(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['profile_photo']) && $data['profile_photo']) {
            $uploadedPhoto = $this->uploadImage($data['profile_photo'], 'users/profiles');
            $data['profile_photo'] = $uploadedPhoto;
        }

        return $this->userRepo->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['profile_photo']) && $data['profile_photo']) {
            $uploadedPhoto = $this->uploadImage($data['profile_photo'], 'users/profiles');
            $data['profile_photo'] = $uploadedPhoto;
        }
        return $this->userRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }
    public function assignToGroups($userId, array $groupIds)
    {
        return $this->userRepo->assignToGroups($userId, $groupIds);
    }
    public function removeFromGroups($userId, array $groupIds)
    {
        return $this->userRepo->removeFromGroups($userId, $groupIds);
    }
}