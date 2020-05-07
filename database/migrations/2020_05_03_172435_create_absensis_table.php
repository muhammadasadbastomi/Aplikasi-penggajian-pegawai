<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->length(36);
            $table->unsignedBigInteger('periode_id');
            $table->tinyInteger('pegawai_id');
            $table->tinyInteger('izin')->nullable();
            $table->tinyInteger('sakit')->nullable();
            $table->tinyInteger('alfa')->nullable();
            $table->tinyInteger('hadir')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('keterangan')->nullable();
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('restrict');
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
        Schema::dropIfExists('absensis');
    }
}
