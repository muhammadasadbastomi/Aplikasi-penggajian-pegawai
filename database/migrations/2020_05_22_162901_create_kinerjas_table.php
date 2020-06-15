<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerjas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->length(36);
            $table->tinyInteger('pegawai_id');
            $table->tinyInteger('periode_id');
            $table->string('disiplin')->nullable();
            $table->string('waktu')->nullable();
            $table->string('honor')->default('2000000');
            $table->string('penyelesaian')->nullable();
            $table->string('inisiatif')->nullable();
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
        Schema::dropIfExists('kinerjas');
    }
}
