<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Golongan;
use Faker\Factory as FakerID;
use Faker\Generator as Faker;

$factory->define(Golongan::class, function (Faker $faker) {
    $faker = FakerID::create('id_ID');
    return [
        'uuid' => $faker->uuid,
        'golongan' => $faker->word(20),
        'keterangan' => $faker->word(30),
    ];
});
