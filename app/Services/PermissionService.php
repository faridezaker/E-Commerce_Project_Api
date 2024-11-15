<?php

namespace App\Services;

use App\Http\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    public function all()
    {
        return PermissionResource::collection(Permission::all());
    }
}
