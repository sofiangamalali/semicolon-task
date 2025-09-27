<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsRequest;
use App\Models\Group;
use App\Services\GroupService;
use App\Traits\ResponseTrait;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GroupController extends Controller
{
    use ResponseTrait, AuthorizesRequests;

    public function __construct(private GroupService $groupService)
    {
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Group::class);
        $filters = $request->only(['name', 'description']);
        $groups = $this->groupService->getAll($filters, $request->get('per_page', 15));

        return $this->success(GroupResource::collection($groups));
    }

    public function show(Group $group)
    {
        $this->authorize('view', $group);

        $groupData = $this->groupService->findById($group->id);

        return $this->success(new GroupResource($groupData));
    }

    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);

        $group = $this->groupService->create($request->validated());

        return $this->success(
            new GroupResource($group),
            'Group created successfully',
            201
        );
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);
        $this->groupService->update($group->id, $request->validated());
        $group->refresh();
        return $this->success(
            new GroupResource($group),
            'Group updated successfully'
        );
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $this->groupService->delete($group->id);

        return $this->success(null, 'Group deleted successfully');
    }

    public function assignPermissions(PermissionsRequest $request, Group $group)
    {
        $this->authorize('assignPermissions', $group);

        $this->groupService->assignPermissions($group->id, $request->permission_ids);

        return $this->success(null, 'Permissions assigned successfully');
    }

    public function removePermissions(PermissionsRequest $request, Group $group)
    {
        $this->authorize('assignPermissions', $group);

        $this->groupService->removePermissions($group->id, $request->permission_ids);

        return $this->success(null, 'Permissions removed successfully');
    }
}