<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->length(36);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('golongan_id')->nullable();
            $table->string('nik');
            $table->string('nama');
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->enum('pekerja', ['Karyawan', 'Pegawai']);
            $table->text('alamat');
            $table->text('tempat_lahir');
            $table->date('tgl_lahir');
            $table->date('tgl_masuk');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('restrict');
            $table->foreign('golongan_id')->references('id')->on('golongans')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
