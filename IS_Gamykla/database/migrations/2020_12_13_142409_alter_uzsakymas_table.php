<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUzsakymasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uzsakymas', function (Blueprint $table) {
            $table->string('salis')->nullable()->change();
            $table->string('miestas')->nullable()->change();
            $table->string('gatve')->nullable()->change();
            $table->string('buto_nr')->nullable()->change();
            $table->integer('fk_userId')->unsigned()->nullable()->change();
            $table->integer('fk_bankoKorteleId')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uzsakymas', function (Blueprint $table) {
            $table->string('salis')->change();
            $table->string('miestas')->change();
            $table->string('gatve')->change();
            $table->string('buto_nr')->change();
            $table->integer('fk_userId')->unsigned()->change();
            $table->integer('fk_bankoKorteleId')->unsigned()->change();
        });
    }
}
