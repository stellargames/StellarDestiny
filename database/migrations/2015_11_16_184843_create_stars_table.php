<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStarsTable extends Migration {

	public function up()
	{
		Schema::create('stars', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('stars');
	}
}
