<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrekeSandelyjeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preke_sandelyje', function (Blueprint $table) {
            $table->id();
            $table->integer('kiekis');
            $table->foreignId('fk_SandelisId')->constrained('sandeliai');
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
        Schema::dropIfExists('preke_sandelyje');
    }
}
