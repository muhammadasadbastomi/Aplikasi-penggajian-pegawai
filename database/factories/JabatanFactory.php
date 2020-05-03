<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Jabatan;
use Faker\Generator as Faker;
use Faker\Factory as FakerID;

$factory->define(Jabatan::class, function (Faker $faker) {
    $faker = FakerID::create('id_ID');
    return [
        'uuid' => $faker->uuid,
        'kode_jabatan' => $faker->unique()->word(20),
        'jabatan' => $faker->word(20),
        'keterangan' => $faker->word(30),
    ];
    
});
