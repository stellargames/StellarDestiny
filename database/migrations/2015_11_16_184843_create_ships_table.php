<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipsTable extends Migration
{

    public function up()
    {
        Schema::create(
            'ships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('star_name', 8)->nullable();
            $table->integer('ship_type_id')->unsigned();
            $table->integer('energy')->unsigned()->default(0);
            $table->integer('structure')->unsigned()->default(0);
            $table->integer('credits')->default(0);
            $table->string('name', 64);
            $table->timestamps();
        }
        );
    }


    public function down()
    {
        Schema::drop('ships');
    }
}
