<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Post', 'User'] as $name) {
            GroupPermission::create(['name' => $name]);
        }
    }
}
