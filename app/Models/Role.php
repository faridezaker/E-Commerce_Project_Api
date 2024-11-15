<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends  \Spatie\Permission\Models\Role
{
    use HasFactory;

    public $permissionsArray;

    public function setPermissionsArray(array $permissions)
    {
        $this->permissionsArray = $permissions;
    }
}
