<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name'  =>  'user_access'],
            ['name'  =>  'user_create'],
            ['name'  =>  'user_edit'],
            ['name'  =>  'user_show'],
            ['name'  =>  'user_delete'],
            ['name'  =>  'role_access'],
            ['name'  =>  'role_create'],
            ['name'  =>  'role_edit'],
            ['name'  =>  'role_show'],
            ['name'  =>  'role_delete'],
            ['name'  =>  'user_management_access'],
            ['name'  =>  'user_excel_export'],
            ['name' => 'category_access'],
            ['name' => 'category_create'],
            ['name' => 'category_show'],
            ['name' => 'category_edit'],
            ['name' => 'category_delete'],
            ['name' => 'book_access',],
            ['name' => 'book_create'],
            ['name' => 'book_show'],
            ['name' => 'book_edit'],
            ['name' => 'book_delete'],
            ['name' => 'customer_access',],
            ['name' => 'customer_create'],
            ['name' => 'customer_show'],
            ['name' => 'customer_edit'],
            ['name' => 'customer_delete'],
            ['name' => 'sale_access',],
            ['name' => 'sale_create'],
            ['name' => 'sale_show'],
            ['name' => 'sale_edit'],
            ['name' => 'sale_delete'],
            ['name' => 'report_access'],
        ];

        collect($permissions)->map(function ($permission) {
            Permission::create($permission);
        });
    }
}
