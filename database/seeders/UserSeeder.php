<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => "admin",
            'first_name' => "Yousuf",
            'last_name' => "Alhajri",
            'email' => "joe@omani.cloud",
            'password' => Hash::make('password'),
            'gender' => "Male",
            'is_verified' => 1,
            'role' => "admin",
            'about' => "I'm the best admin, for sure.",
            'status' => 1,
        ]);
    }
}