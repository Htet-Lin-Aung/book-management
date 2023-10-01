<?php
namespace App\Repositories\Interfaces;

use App\Models\Category;

Interface CategoryRepositoryInterface{
    public function all();
    public function allWithPaginate($paginate);
    public function create($data);
    public function update(Category $category, $data);
    public function search($key);
}
