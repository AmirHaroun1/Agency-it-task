<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin'.'@gmail.com',
            'is_admin'=>1,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'employee User 1',
            'email' => 'employee1'.'@gmail.com',
            'is_admin'=>0,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'employee User 2',
            'email' => 'employee2'.'@gmail.com',
            'is_admin'=>0,
            'password' => Hash::make('password'),
        ]);
    }
}
