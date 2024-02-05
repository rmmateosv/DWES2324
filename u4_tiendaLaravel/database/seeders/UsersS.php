<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insertar el uuario admin
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('admin'),
            'tipo'=>'A'
        ]);
    }
}
