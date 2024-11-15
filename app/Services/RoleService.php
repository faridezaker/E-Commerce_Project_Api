<?php

namespace App\Services;

use App\Http\Resources\RoleResource;
use App\Models\Role;

class RoleService
{
    public function allRolesAndPermissions()
    {
        return RoleResource::collection(Role::all());
    }

    public function store($data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->setPermissionsArray($data['permissions']);
        $role->save();
        return new RoleResource($role);
    }

    public function find($Role)
    {
        return new RoleResource($Role);
    }

    public function update($data, $role)
    {

    }
}
