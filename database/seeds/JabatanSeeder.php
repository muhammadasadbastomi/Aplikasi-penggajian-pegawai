<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('id_ID');
        
        // for($i = 1; $i<=100; $i++)
        // {
        //     $bpk = DB::Table('bpks')->insert([
        //         'uuid' => $faker->uuid,
        //         'name' => $faker->name,
        //         'date_est' => $faker->date,
        //         'address' => $faker->address
        //     ]);

        //     for($i = 1; $i<=10; $i++)
        //     {
        //     $member = DB::Table('members')->insert([
        //         'bpk_id' => $bpk->id,
        //         'uuid' => $faker->uuid,
        //         'member_number' => $faker->number,
        //         'birth_place' => $faker->city,
        //         'birth_date' => $faker->date,
        //         'address' => $faker->address,
        //         'gender' => $faker->numberBetween(1,2),
        //         'position' => $faker->numberBetween(1,2),
        //         'height_body' => $faker->numberBetween($min = 155, $max = 180),
        //         'weight_body' => $faker->numberBetween($min = 60, $max = 120),
        //         'photo' => $faker->name,
        //     ]);
        //     }
        // }
    }
}
