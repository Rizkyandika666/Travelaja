<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesawatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesawats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pesawat');
            $table->string('partner');
            $table->string('kode_pesawat');
            $table->float('harga');
            $table->integer('kursi_ekonomi');
            $table->integer('kursi_bisnis');
            $table->integer('kursi_vip');
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
        Schema::dropIfExists('pesawats');
    }
}
