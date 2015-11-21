<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFactionsToPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->integer('faction_id')->unsigned()->nullable();
        });
        Schema::table('players', function(Blueprint $table) {
            $table->foreign('faction_id')->references('id')->on('factions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function(Blueprint $table) {
            $table->dropForeign('players_faction_id_foreign');
        });
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('faction_id');
        });
    }
}
