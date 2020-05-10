<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(BpkSeeder::class);
        // Create 100 records of bpks
        factory(App\Jabatan::class, 3)->create()->each(function ($jabatan) {

            // Seed the relation with 10 members
            // $members = factory(App\Member::class, 10)->make();
            // $bpk->members()->saveMany($members);
        });

        factory(App\Golongan::class, 3)->create()->each(function ($golongan) {

            // Seed the relation with 10 members
            // $members = factory(App\Member::class, 10)->make();
            // $bpk->members()->saveMany($members);
        });

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
