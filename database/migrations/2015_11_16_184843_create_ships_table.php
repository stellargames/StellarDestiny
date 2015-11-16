<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipsTable extends Migration {

	public function up()
	{
		Schema::create('ships', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('player_id')->unsigned();
			$table->integer('star_id')->unsigned()->nullable();
			$table->integer('ship_type_id')->unsigned();
			$table->integer('energy')->unsigned();
			$table->integer('structure')->unsigned();
			$table->integer('credits');
			$table->string('name', 64);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ships');
	}
}