<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTraderTable extends Migration {

	public function up()
	{
		Schema::create('item_trader', function(Blueprint $table) {
			$table->integer('item_id')->unsigned();
			$table->integer('trader_id')->unsigned();
			$table->integer('amount')->unsigned();
			$table->integer('wanted')->unsigned();
			$table->integer('balance');
		});
	}

	public function down()
	{
		Schema::drop('item_trader');
	}
}
