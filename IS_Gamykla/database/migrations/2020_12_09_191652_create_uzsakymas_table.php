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
            $table->id();
            $table->timestamps();
            $table->string('salis');
            $table->string('miestas');
            $table->string('gatve');
            $table->string('buto nr.');
            $table->string('uzsakymo_statusas');
            $table->string('pristatymo_komentaras')->nullable();
            $table->integer('duru_kodas')->nullable();
            $table->foreignId('fk_UserId')->constrained('users');
            $table->foreignId('fk_BankoKorteleId')->constrained('banko_kortele');
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
