<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTradersTable extends Migration
{

    public function up()
    {
        Schema::create(
            'traders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('star_id')->unsigned();
            $table->string('name', 64);
            $table->timestamps();
        }
        );
    }


    public function down()
    {
        Schema::drop('traders');
    }
}
