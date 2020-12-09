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
            $table->string('salis');
            $table->string('miestas');
            $table->string('gatve');
            $table->string('buto_nr');
            $table->string('uzsakymo_statusas');
            $table->string('pristatymo_komentaras')->nullable();
            $table->integer('duru_kodas')->nullable();
            $table->integer('fk_userId')->unsigned();
            $table->integer('fk_BankoKorteleId')->unsigned();
            $table->foreign('fk_userId')->references('id')->on('users');
            $table->foreign('fk_BankoKorteleId')->references('korteles_numeris')->on('banko_korteles');
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
