<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rak', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('pengarang');
            $table->string('tahun_terbit');
            $table->string('urlimages');
            $table->string('urlpdf');
            $table->string('status');
            $table->string('status_buku_jurnal');
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
        Schema::dropIfExists('jurnal');
    }
}