<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvarkarastisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvarkarastis', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('darbas_nuo');
            $table->integer('darbas_iki');
            $table->integer('fk_darbuotojasId')->unsigned();
            $table->integer('fk_vadovasId')->nullable()->unsigned();
            $table->foreign('fk_darbuotojasId')->references('id')->on('users');
            $table->foreign('fk_vadovasId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tvarkarastis');
    }
}
