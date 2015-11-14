<?php

use Illuminate\Database\Seeder;
use Stellar\ItemType;

class ItemTypeTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('item_types')->delete();

		// armor
		ItemType::create(array(
				'name' => 'Armor',
				'description' => 'Armor plating protects your ship from damage. It is more effective against kinetic weapons than beam weapons.'
			));

		// shield
		ItemType::create(array(
				'name' => 'Shields',
				'description' => 'Electromagnetic shields protect your ship from damage. It is more effective against beam weapons than kinetic weapons.'
			));

		// beam
		ItemType::create(array(
				'name' => 'Beam weapon',
				'description' => 'Beam weapons can damage other ships. They are not very effective against electromagnetic shields though.'
			));

		// kinetic
		ItemType::create(array(
				'name' => 'Kinetic weapon',
				'description' => 'Kinetic weapons can damage other ships. They are not very effective against armor plating though.'
			));

		// jumpstore
		ItemType::create(array(
				'name' => 'Jumpstore',
				'description' => 'Jumpstores are energy storage devices that power the jumps through the starlinks.'
			));
	}
}