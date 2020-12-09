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
            $table->foreignId('sandelis_id')->constrained('sandeliai');
            $table->foreignId('preke_id')->constrained('preke');
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
