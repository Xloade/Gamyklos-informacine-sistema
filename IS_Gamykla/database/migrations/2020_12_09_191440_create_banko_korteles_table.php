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
            $table->id('Korteles_numeris');
            $table->string('Vardas');
            $table->string('Pavarde');
            $table->integer('CVV');
            $table->integer('Galiojimo_pabaigos_menuo');
            $table->integer('Galiojimo_pabaigos_metai');
            $table->integer('Gatve');
            $table->integer('Buto_nr');
            $table->integer('Miestas');
            $table->integer('Salis');
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
