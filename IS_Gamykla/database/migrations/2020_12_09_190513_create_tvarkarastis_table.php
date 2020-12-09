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
            $table->dateTime('laikas');
            $table->foreignId('darbuotojas_id')->constrained('users');
            $table->foreignId('vadovas_id')->constrained('users');
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
