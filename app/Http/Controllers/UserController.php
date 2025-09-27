<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use App\Http\Requests\GroupsRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use ResponseTrait;
    use AuthorizesRequests;

    public function __construct(private UserService $userService)
    {
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $filters = $request->only(['name', 'email', 'phone', 'role']);
        $users = $this->userService->getAll($filters, $request->get('per_page', 15));

        return $this->paginated($users, UserResource::class);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        $userData = $this->userService->findById($user->id);

        return $this->success(new UserResource($userData));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $user = $this->userService->create($request->validated());

        return $this->success(
            new UserResource($user),
            'User created successfully',
            201
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->userService->update($user->id, $request->validated());
        $updatedUser = $this->userService->findById($user->id);

        return $this->success(
            new UserResource($updatedUser),
            'User updated successfully'
        );
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $this->userService->delete($user->id);

        return $this->success(null, 'User deleted successfully');
    }

    public function assignGroups(GroupsRequest $request, User $user)
    {
        $this->authorize('assignGroups', $user);

        $this->userService->assignToGroups($user->id, $request->group_ids);

        return $this->success(null, 'Groups assigned successfully');
    }

    public function removeGroups(GroupsRequest $request, User $user)
    {
        $this->authorize('assignGroups', $user);

        $this->userService->removeFromGroups($user->id, $request->group_ids);

        return $this->success(null, 'Groups removed successfully');
    }
}