<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('userlevel')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->string('salis')->nullable();
            $table->string('miestas')->nullable();
            $table->string('gatve')->nullable();
            $table->string('buto_nr')->nullable();
            $table->integer('duru_kodas')->nullable();

            $table->float('atlyginimas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
