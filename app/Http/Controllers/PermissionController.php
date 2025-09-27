<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Services\PermissionService;
use App\Traits\ResponseTrait;
use App\Http\Resources\PermissionResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;

class PermissionController extends Controller
{
    use ResponseTrait, AuthorizesRequests;

    public function __construct(private PermissionService $permissionService)
    {
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        $permissions = $this->permissionService->getAll();
        return $this->success(PermissionResource::collection($permissions));
    }
}