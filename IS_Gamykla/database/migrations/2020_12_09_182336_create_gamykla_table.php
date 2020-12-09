<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamyklaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamykla', function (Blueprint $table) {
            $table->increments('kodas');
            $table->string('adresas');
            $table->string('pavadinimas');
            $table->integer('fk_userId')->nullable()->unsigned();
            $table->foreign('fk_userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gamykla');
    }
}
