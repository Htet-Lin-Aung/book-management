<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;


class PermissionRepository implements PermissionRepositoryInterface
{

    public function allPermissions()
    {
        return Permission::pluck('id', 'name');
    }

}
