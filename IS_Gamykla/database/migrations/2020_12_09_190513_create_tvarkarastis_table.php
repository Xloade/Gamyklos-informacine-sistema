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
            $table->id();
            $table->date('data');
<<<<<<< HEAD
            $table->dateTime('data');
            $table->foreignId('fk_DarbuotojasId')->constrained('users');
            $table->foreignId('fk_vadovasId')->constrained('users');
=======
            $table->dateTime('Laikas');
            $table->foreignId('darbuotojas_id')->constrained('users');
            $table->foreignId('vadovas_id')->constrained('users');
>>>>>>> faf818c9b8825703194d46eb77a55d2d082031b2
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
