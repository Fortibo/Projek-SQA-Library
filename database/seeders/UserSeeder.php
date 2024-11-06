<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('roles')->insert([
            'user_id'=> "1",
            'role'=>"kasir"
        ]);
        DB::table('roles')->insert([
            'user_id'=> "3",
            'role'=>"user"
        ]);
    }
}
