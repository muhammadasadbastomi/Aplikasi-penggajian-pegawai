<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pegawai
        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Muhammad Zaini',
            'email' => 'zaini@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Saiful Andi Irawan',
            'email' => 'saiful@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Muhammad Hadrian',
            'email' => 'hadrian@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Indah Permata',
            'email' => 'indah@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Juwita Kila',
            'email' => 'juwita@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Fajar Ramadhan',
            'email' => 'hidayat@gmail.com',
            'role' => 'pegawai',
            'password' => Hash::make('123456'),
        ]);
    }
}
