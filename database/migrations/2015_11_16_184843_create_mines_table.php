<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMinesTable extends Migration {

	public function up()
	{
		Schema::create('mines', function(Blueprint $table) {
			$table->integer('star_id')->unsigned();
			$table->integer('player_id')->unsigned()->nullable();
			$table->integer('item_id')->unsigned();
			$table->integer('trigger')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('mines');
	}
}
