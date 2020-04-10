<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStasiunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stasiuns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('town_id')->unsigned();
           $table->foreign('town_id')->references('id')->on('towns')->onDelete('cascade');
            $table->string('nama_stasiun');
            $table->string('kode');
            $table->string('status');
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
        Schema::dropIfExists('stasiuns');
    }
}
