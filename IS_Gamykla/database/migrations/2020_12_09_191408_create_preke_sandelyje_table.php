<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrekeSandelyjeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preke_sandelyje', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kiekis');
            $table->integer('fk_sandelisId')->unsigned();
            $table->foreign('fk_sandelisId')->references('sandelio_kodas')->on('sandeliai');
            $table->integer('fk_prekeId')->unsigned();
            $table->foreign('fk_prekeId')->references('prekes_kodas')->on('preke');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preke_sandelyje');
    }
}
