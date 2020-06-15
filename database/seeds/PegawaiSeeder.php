<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data ke table pegawai
        DB::table('pegawais')->insert([
            'uuid' => Str::random(36),
            'user_id' => 2,
            'nik' => '28192371293',
            'nama' => 'Joni',
            'pekerja' => 'Karyawan',
            'alamat' => 'Jln.Banjarbaru',
            'tempat_lahir' => 'Jln.Banjarmasin',
            'tgl_lahir' => '2001-03-03',
            'tgl_masuk' => '2009-03-03'
        ]);
    }
}
