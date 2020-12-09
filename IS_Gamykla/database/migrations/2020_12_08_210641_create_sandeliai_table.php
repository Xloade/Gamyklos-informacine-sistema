<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSandeliaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sandeliai', function (Blueprint $table) {
            $table->increments('sandelio_kodas');
            $table->string('salis');
            $table->string('miestas');
            $table->string('gatve');
            $table->float('talpa');
            $table->integer('fk_vadovasId')->nullable()->unsigned();
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
        Schema::dropIfExists('sandeliai');
    }
}
