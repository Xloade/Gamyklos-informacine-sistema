<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrekeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preke', function (Blueprint $table) {
            $table->id('prekes_kodas');
            $table->float('kaina');
            $table->float('svoris');
            $table->string('pavadinimas');
            $table->float('aukstis');
            $table->float('ilgis');
            $table->float('plotis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preke');
    }
}
