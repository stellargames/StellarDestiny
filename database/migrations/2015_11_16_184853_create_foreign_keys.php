<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->foreign('current_ship')->references('id')->on('ships')->onDelete('set null')->onUpdate('set null');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('set null')->onUpdate('set null');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->foreign('ship_type_id')->references('id')->on('ship_types')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('traders', function (Blueprint $table) {
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('type')->references('id')->on('item_types')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('star_links', function (Blueprint $table) {
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('star_links', function (Blueprint $table) {
            $table->foreign('destination')->references('id')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('item_trader', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('item_trader', function (Blueprint $table) {
            $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('item_ship', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('item_ship', function (Blueprint $table) {
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')->onDelete('set null')->onUpdate('set null');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign('players_current_ship_foreign');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->dropForeign('ships_player_id_foreign');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->dropForeign('ships_star_id_foreign');
        });
        Schema::table('ships', function (Blueprint $table) {
            $table->dropForeign('ships_ship_type_id_foreign');
        });
        Schema::table('traders', function (Blueprint $table) {
            $table->dropForeign('traders_star_id_foreign');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_type_foreign');
        });
        Schema::table('star_links', function (Blueprint $table) {
            $table->dropForeign('star_links_star_id_foreign');
        });
        Schema::table('star_links', function (Blueprint $table) {
            $table->dropForeign('star_links_destination_foreign');
        });
        Schema::table('item_trader', function (Blueprint $table) {
            $table->dropForeign('item_trader_item_id_foreign');
        });
        Schema::table('item_trader', function (Blueprint $table) {
            $table->dropForeign('item_trader_trader_id_foreign');
        });
        Schema::table('item_ship', function (Blueprint $table) {
            $table->dropForeign('item_ship_item_id_foreign');
        });
        Schema::table('item_ship', function (Blueprint $table) {
            $table->dropForeign('item_ship_ship_id_foreign');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->dropForeign('mines_star_id_foreign');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->dropForeign('mines_player_id_foreign');
        });
        Schema::table('mines', function (Blueprint $table) {
            $table->dropForeign('mines_item_id_foreign');
        });
    }
}
