<?php
namespace App\Repositories\Interfaces;
use App\Models\User;

Interface UserRepositoryInterface{

    public function all($paginate);
    public function store($data);
    public function update(User $user, $data);
    public function destroy(User $user);
    public function search($data);
    public function exportExcel();
}
