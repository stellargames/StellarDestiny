<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveItemTypes extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_type_foreign');
            $table->string('type', 32)->change();
        });
        Schema::drop('item_types');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('item_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('type')->references('id')->on('item_types')->onDelete('restrict')->onUpdate('restrict');
        });
    }
}
