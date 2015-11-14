<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->text('description');
			$table->integer('value');
			$table->integer('type')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}