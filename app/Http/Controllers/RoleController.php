<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AttachRolePermissionRequest;
use App\Http\Requests\Auth\CreatePermissionRequest;
use App\Http\Requests\Auth\CreateRoleRequest;
use App\Http\Resources\User\PermissionResource;
use App\Http\Resources\User\RoleResource;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
    }

    public function roles()
    {
        return $this->response(
            data: RoleResource::collection(Role::all())
        );
    }

    public function permissions()
    {
        return $this->response(
            data: PermissionResource::collection(Permission::all())
        );
    }

    public function rolePermissions(Role $role)
    {
        return $this->response(
            data: PermissionResource::collection($role->permissions)
        );
    }

    public function create(CreateRoleRequest $resquest)
    {
        $role = Role::query()->create($resquest->only('name'));

        return $this->response(
            data: new RoleResource($role)
        );
    }

    public function attachPermissionToRole(Role $role, AttachRolePermissionRequest $request)
    {
        $permissions = Permission::query()->whereIn('name',$request->get('permissions'))->get();
        $role->syncPermissions($permissions);

        return $this->response();
    }

    public function assignRoleToUser(Role $role,User $user)
    {
        $user->roles()->attach($role);
        return $this->response();
    }
}
