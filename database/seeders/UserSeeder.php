<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => bcrypt("password"),
        ]);
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt("password"),
        ]);

        DB::table('roles')->insert([
            'user_id'=> "1",
            'role'=>"user"
        ]);
        DB::table('roles')->insert([
            'user_id'=> "2",
            'role'=>"admin"
        ]);

        DB::table('books')->insert([
            'judul'=> "Halo",
            'penulis'=> "Eric Yoel",
            'deskripsi'=> "aieuawrgblfbefbfikwfhjfbw"
        ]);
        DB::table('books')->insert([
            'judul'=> "Halo1",
            'penulis'=> "Eric Yoel1",
            'deskripsi'=> "aieuawrgblfbefbfikwfhjfbw"
        ]);
        DB::table('books')->insert([
            'judul'=> "Halo2",
            'penulis'=> "Eric Yoel2",
            'deskripsi'=> "aieuawrgblfbefbfikwfhjfbw"
        ]);
        DB::table('books')->insert([
            'judul'=> "Halo3",
            'penulis'=> "Eric Yoel3",
            'deskripsi'=> "aieuawrgblfbefbfikwfhjfbw"
        ]);
        DB::table('books')->insert([
            'judul'=> "Halo4",
            'penulis'=> "Eric Yoel4",
            'deskripsi'=> "aieuawrgblfbefbfikwfhjfbw"
        ]);
    }
}
