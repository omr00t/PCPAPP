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
        $user = DB::table('users')->where('email', 'joe@omani.cloud')->first();
        if ($user === null) {
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
            DB::table('users')->insert([
                'username' => "khalid",
                'first_name' => "Khalid",
                'last_name' => "Alhajri",
                'email' => "khalid@omani.cloud",
                'password' => Hash::make('hello123'),
                'gender' => "Male",
                'is_verified' => 1,
                'role' => "user",
                'about' => "A simple user.",
                'status' => 1,
            ]);
            DB::table('users')->insert([
                'username' => "rashid",
                'first_name' => "Rashid",
                'last_name' => "Alhajri",
                'email' => "rashid@omani.cloud",
                'password' => Hash::make('rashid123'),
                'gender' => "Male",
                'is_verified' => 1,
                'role' => "manager",
                'about' => "A manager.",
                'status' => 1,
            ]);
        }
    }
}
