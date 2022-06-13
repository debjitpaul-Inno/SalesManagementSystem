<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $roles = [
            [
                "title" => 'Owner',
            ],
            [
                "title" => 'Admin',
            ],
            [
                "title" => 'Accountant',
            ],
            [
                "title" => 'Staff',
            ]
        ];

        foreach ($roles as $role) {
            $role = Role::create($role);
            $permissions = Permission::all();
            if ($role->slug == 'owner'){
                foreach ($permissions as $permission){
                    $role->permissions()->attach($permission->id);
                }
            }
        }
    }
}
