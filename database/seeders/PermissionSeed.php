<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['read_post', 'edit_post', 'create_post', 'delete_post', 'read_user', 'edit_user', 'create_user', 'delete_user'] as $key => $name){
            Permission::create(['name' => $name, 'group_id' => $key < 4 ? 1 : 2]);
        }
    }
}
