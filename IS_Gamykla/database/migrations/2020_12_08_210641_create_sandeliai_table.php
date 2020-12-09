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
            $table->id('sandelio_kodas');
            $table->string('salis');
            $table->string('miestas');
            $table->string('gatve');
            $table->float('talpa');
            $table->foreignId('fk_VadovasId')->nullable()->constrained('users');
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
