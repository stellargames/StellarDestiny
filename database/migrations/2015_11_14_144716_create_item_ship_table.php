<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemShipTable extends Migration {

	public function up()
	{
		Schema::create('item_ship', function(Blueprint $table) {
			$table->integer('item_id')->unsigned();
			$table->integer('ship_id')->unsigned();
			$table->integer('amount')->unsigned();
			$table->integer('paid');
		});
	}

	public function down()
	{
		Schema::drop('item_ship');
	}
}