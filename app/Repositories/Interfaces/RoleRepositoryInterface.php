<?php
namespace App\Repositories\Interfaces;
use Spatie\Permission\Models\Role;

Interface RoleRepositoryInterface{

    public function allRoles();
    public function allRolesWithPaginate($paginate);
    public function store($data);
    public function update(Role $role, $data);
    public function destroy(Role $role);
}
