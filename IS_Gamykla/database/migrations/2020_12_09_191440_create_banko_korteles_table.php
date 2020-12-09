<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankoKortelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banko_korteles', function (Blueprint $table) {
            $table->id('korteles_numeris');
            $table->string('vardas');
            $table->string('pavarde');
            $table->integer('cvv');
            $table->integer('galiojimo_pabaigos_menuo');
            $table->integer('galiojimo_pabaigos_metai');
            $table->string('gatve');
            $table->string('buto_nr');
            $table->string('miestas');
            $table->string('salis');
            $table->foreignId('fk_userId')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banko_korteles');
    }
}
