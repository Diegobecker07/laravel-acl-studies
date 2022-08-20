<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'sa@email.com',
            'password' => bcrypt(123),
        ])->roles()->attach(1);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt(123),
        ])->roles()->attach(2);

        User::create([
            'name' => 'Author',
            'email' => 'author@email.com',
            'password' => bcrypt(123),
        ])->roles()->attach(3);

        User::create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt(123),
        ])->roles()->attach(4);
    }
}
