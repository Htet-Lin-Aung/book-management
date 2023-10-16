<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'user'],
            ['name' => 'admin'],
        ];

        collect($roles)->map(function ($role) {
            Role::create($role);
        });
    }
}
