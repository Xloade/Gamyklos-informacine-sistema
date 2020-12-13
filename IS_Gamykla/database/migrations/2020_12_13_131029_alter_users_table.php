<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'fk_gamykla')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('fk_gamykla')->nullable()->unsigned();
                $table->foreign('fk_gamykla')->references('kodas')->on('gamykla');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'fk_gamykla')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('fk_gamykla');
            });
        }
    }
}
