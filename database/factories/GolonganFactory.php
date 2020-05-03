<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Golongan;
use Faker\Generator as Faker;
use Faker\Factory as FakerID;

$factory->define(Golongan::class, function (Faker $faker) {
    $faker = FakerID::create('id_ID');
    return [
        'uuid' => $faker->uuid,
        'kode_golongan' => $faker->unique()->word(20),
        'golongan' => $faker->word(20),
        'keterangan' => $faker->word(30),
    ];
});
