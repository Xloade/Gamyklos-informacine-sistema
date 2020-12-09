<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUzsakymasPrekeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzsakymas_preke', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kiekis');
            $table->integer('fk_UzsakymasId')->unsigned();
            $table->integer('fk_PrekeSandelyjeId')->unsigned();
            $table->foreign('fk_UzsakymasId')->references('id')->on('uzsakymas');
            $table->foreign('fk_PrekeSandelyjeId')->references('id')->on('preke_sandelyje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uzsakymas_preke');
    }
}
