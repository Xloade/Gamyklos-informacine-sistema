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
            $table->id();
            $table->integer('kiekis');
            $table->foreignId('fk_UzsakymasId')->constrained('uzsakymas');
            $table->foreignId('fk_PrekeSandelyjeId')->constrained('preke_sandelyje');
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
