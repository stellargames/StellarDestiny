<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStarLinksTable extends Migration
{

    public function up()
    {
        Schema::create(
            'star_links', function (Blueprint $table) {
            $table->string('star_name', 8)->index();
            $table->string('destination', 8);
        }
        );
    }


    public function down()
    {
        Schema::drop('star_links');
    }
}
