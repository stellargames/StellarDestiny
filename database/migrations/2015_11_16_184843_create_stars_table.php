<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStarsTable extends Migration
{

    public function up()
    {
        Schema::create(
            'stars', function (Blueprint $table) {
            $table->string('name', 8)->unique();
        }
        );
    }

    public function down()
    {
        Schema::drop('stars');
    }
}
