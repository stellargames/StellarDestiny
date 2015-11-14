<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShipTypesTable extends Migration {

	public function up()
	{
		Schema::create('ship_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->text('description');
			$table->smallInteger('slots')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ship_types');
	}
}