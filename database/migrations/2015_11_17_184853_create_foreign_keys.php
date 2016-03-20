<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table(
            'users', function (Blueprint $table) {
            $table->foreign('current_ship')->references('id')->on('ships')->onDelete('set null')->onUpdate('set null');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->foreign('star_name')->references('name')->on('stars')->onDelete('set null')->onUpdate('set null');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->foreign('ship_type_id')->references('id')->on('ship_types')->onDelete('restrict')->onUpdate(
                'restrict'
            );
        }
        );
        Schema::table(
            'traders', function (Blueprint $table) {
            $table->foreign('star_name')->references('name')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'item_trader', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'item_trader', function (Blueprint $table) {
            $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'item_ship', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict')->onUpdate('restrict');
        }
        );
        Schema::table(
            'item_ship', function (Blueprint $table) {
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->foreign('star_name')->references('name')->on('stars')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        }
        );
        Schema::table(
            'users', function (Blueprint $table) {
            $table->foreign('faction_id')->references('id')->on('factions')->onDelete('cascade')->onUpdate('cascade');
        }
        );
    }


    public function down()
    {
        Schema::table(
            'users', function (Blueprint $table) {
            $table->dropForeign('users_current_ship_foreign');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->dropForeign('ships_user_id_foreign');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->dropForeign('ships_star_name_foreign');
        }
        );
        Schema::table(
            'ships', function (Blueprint $table) {
            $table->dropForeign('ships_ship_type_id_foreign');
        }
        );
        Schema::table(
            'traders', function (Blueprint $table) {
            $table->dropForeign('traders_star_name_foreign');
        }
        );
        Schema::table(
            'star_links', function (Blueprint $table) {
            $table->dropForeign('star_links_star_name_foreign');
        }
        );
        Schema::table(
            'star_links', function (Blueprint $table) {
            $table->dropForeign('star_links_destination_foreign');
        }
        );
        Schema::table(
            'item_trader', function (Blueprint $table) {
            $table->dropForeign('item_trader_item_id_foreign');
        }
        );
        Schema::table(
            'item_trader', function (Blueprint $table) {
            $table->dropForeign('item_trader_trader_id_foreign');
        }
        );
        Schema::table(
            'item_ship', function (Blueprint $table) {
            $table->dropForeign('item_ship_item_id_foreign');
        }
        );
        Schema::table(
            'item_ship', function (Blueprint $table) {
            $table->dropForeign('item_ship_ship_id_foreign');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->dropForeign('mines_star_name_foreign');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->dropForeign('mines_user_id_foreign');
        }
        );
        Schema::table(
            'mines', function (Blueprint $table) {
            $table->dropForeign('mines_item_id_foreign');
        }
        );
        Schema::table(
            'users', function (Blueprint $table) {
            $table->dropForeign('users_faction_id_foreign');
        }
        );
    }
}
