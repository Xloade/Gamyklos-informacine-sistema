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
            $table->dateTime('laikas');
            $table->integer('darbuotojas_id')->unsigned();
            $table->integer('vadovas_id')->unsigned();
            $table->foreign('darbuotojas_id')->references('id')->on('users');
            $table->foreign('vadovas_id')->references('id')->on('users');
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
