<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Jabatan;
use Faker\Factory as FakerID;
use Faker\Generator as Faker;

$factory->define(Jabatan::class, function (Faker $faker) {
    $faker = FakerID::create('id_ID');
    return [
        'uuid' => $faker->uuid,
        'jabatan' => $faker->word(20),
        'gaji_pokok' => '5000000',
        'tunjangan' => '5000000',
    ];

});
