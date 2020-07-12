<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $format =

            // insert data ke table pegawai
            DB::table('pegawais')->insert([
                'uuid' => Str::random(36),
                'user_id' => 2,
                'nik' => $faker->ean13,
                'nama' => 'Muhammad Zaini',
                'alamat' => $faker->address,
                'tempat_lahir' => $faker->address,
                'tgl_lahir' => $faker->date,
                'tgl_masuk' => $faker->date(Carbon::now()->addDays(2))
            ]);

        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 3,
            'nik' => $faker->ean13,
            'nama' => 'Saiful Andi Irawan',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->address,
            'tgl_lahir' => $faker->date,
            'tgl_masuk' => $faker->date(Carbon::now()->addDays(-2))
        ]);

        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 4,
            'nik' => $faker->ean13,
            'nama' => 'Muhammad Hadrian',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->address,
            'tgl_lahir' => $faker->date,
            'tgl_masuk' => $faker->date(Carbon::now())
        ]);

        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 5,
            'nik' => $faker->ean13,
            'nama' => 'Indah Permata',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->address,
            'tgl_lahir' => $faker->date,
            'tgl_masuk' => $faker->date(Carbon::now()->addDays(5))
        ]);

        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 6,
            'nik' => $faker->ean13,
            'nama' => 'Juwita Kila',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->address,
            'tgl_lahir' => $faker->date,
            'tgl_masuk' => $faker->date(Carbon::now()->addDays(-4))
        ]);

        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 7,
            'nik' => $faker->ean13,
            'nama' => 'Fajar Ramadhan',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->address,
            'tgl_lahir' => $faker->date,
            'tgl_masuk' => $faker->date(Carbon::now()->addDays(1))
        ]);
    }
}
