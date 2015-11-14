<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayersTable extends Migration {

	public function up()
	{
		Schema::create('players', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->tinyInteger('status')->unsigned();
			$table->mediumInteger('reputation');
			$table->mediumInteger('affiliation');
			$table->integer('current_ship')->unsigned()->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('players');
	}
}