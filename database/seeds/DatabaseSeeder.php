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
        factory(App\Jabatan::class, 10)->create()->each(function ($jabatan) {

            // Seed the relation with 10 members
            // $members = factory(App\Member::class, 10)->make();
            // $bpk->members()->saveMany($members);
        });

        factory(App\Golongan::class, 10)->create()->each(function ($golongan) {

            // Seed the relation with 10 members
            // $members = factory(App\Member::class, 10)->make();
            // $bpk->members()->saveMany($members);
        });

        DB::table('users')->insert([
            'uuid' => Str::random(36),
            'name' => Str::random(10),
            'email' => 'tomycules@gmail.com',
            'photos' => 'default.jpg',
            'password' => Hash::make('48344951'),
        ]);
    }
}
