<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' =>  'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminadmin'),
                'role' => 'admin',
                'unique_token' => Str::random(10),
            ],



            //petugas
            [
                'name' =>  'Petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('adminadmin'),
                'role' => 'petugas',
                'unique_token' => Str::random(10),
            ],
            [
                'name' => 'petugas2',
                'email' => 'petugas2@gmail.com',
                'password' => Hash::make('adminadmin'),
                'role' => 'petugas',
                'unique_token' => Str::random(10),
            ]
        ]);
    }
}
