<?php

namespace App\Repositories;

use Exception;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function allWithPaginate($paginate)
    {
        return Category::paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $category = Category::create($data);
            DB::commit();
            return $category;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Category $category, $data)
    {
        DB::beginTransaction();
        try{
            $category->update($data);
            DB::commit();
            return $category;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function search($key)
    {
        $categories = Category::where('name', 'LIKE', '%' . $key . '%')
        ->paginate(30);

        return $categories;
    }
}
