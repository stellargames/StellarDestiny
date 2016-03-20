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
            $table->string('star_name', 8);
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
