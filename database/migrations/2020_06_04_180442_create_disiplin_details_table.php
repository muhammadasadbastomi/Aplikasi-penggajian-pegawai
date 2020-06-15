<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisiplinDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disiplin_details', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->foreignId('absensi_id')->OnDelete('cascade');
            $table->string('alfa');
            $table->string('izin');
            $table->string('sakit');
            $table->string('hadir');
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
        Schema::dropIfExists('disiplin_details');
    }
}
