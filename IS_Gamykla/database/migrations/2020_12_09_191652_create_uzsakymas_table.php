<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUzsakymasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzsakymas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('salis')->nullable();
            $table->string('miestas')->nullable();
            $table->string('gatve')->nullable();
            $table->string('buto_nr')->nullable();
            $table->string('uzsakymo_statusas');
            $table->string('pristatymo_komentaras')->nullable();
            $table->integer('duru_kodas')->nullable();
            $table->integer('fk_userId')->unsigned();
            $table->bigInteger('fk_bankoKorteleId')->unsigned()->nullable();
            $table->foreign('fk_userId')->references('id')->on('users');
            $table->foreign('fk_bankoKorteleId')->references('korteles_numeris')->on('banko_korteles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uzsakymas');
    }
}
