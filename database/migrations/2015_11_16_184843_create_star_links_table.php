<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStarLinksTable extends Migration
{

    public function up()
    {
        Schema::create(
            'star_links', function (Blueprint $table) {
            $table->integer('star_id')->unsigned()->index();
            $table->integer('destination')->unsigned();
        }
        );
    }


    public function down()
    {
        Schema::drop('star_links');
    }
}
