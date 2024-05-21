<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Isaac',
            'position' => 'Developer',
            'email' => 'adm@admin.com',
            'password' => Hash::make('123456'),
            'permission' => 'adm',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}