<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin'])->givePermissionTo('read_post', 'edit_post', 'create_post', 'delete_post', 'read_user', 'edit_user', 'create_user', 'delete_user');
        Role::create(['name' => 'Author'])->givePermissionTo('read_post', 'edit_post', 'create_post', 'delete_post');
        Role::create(['name' => 'User']);
    }
}
