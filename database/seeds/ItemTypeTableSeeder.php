<?php

use Illuminate\Database\Seeder;
use Stellar\ItemType;

class ItemTypeTableSeeder extends Seeder
{

    public function run()
    {
		DB::table('item_types')->delete();

        // armor
        ItemType::create([
            'name'        => 'Armor',
            'description' => 'Armor plating protects your ship from damage. It is more effective against kinetic weapons than beam weapons.'
        ]);

        // shield
        ItemType::create([
            'name'        => 'Shields',
            'description' => 'Electromagnetic shields protect your ship from damage. It is more effective against beam weapons than kinetic weapons.'
        ]);

        // beam
        ItemType::create([
            'name'        => 'Beam weapon',
            'description' => 'Beam weapons can damage other ships. They are not very effective against electromagnetic shields though.'
        ]);

        // kinetic
        ItemType::create([
            'name'        => 'Kinetic weapon',
            'description' => 'Kinetic weapons can damage other ships. They are not very effective against armor plating though.'
        ]);

        // jumpstore
        ItemType::create([
            'name'        => 'Jumpstore',
            'description' => 'Jumpstores are energy storage devices that power the jumps through the starlinks.'
        ]);

        // mine
        ItemType::create([
            'name'        => 'Mines',
            'description' => 'Mines are a cheap way to limit rival movements.'
        ]);

        // cargo
        ItemType::create([
            'name'        => 'Cargo Pods',
            'description' => 'Cargo pods are designed to hold bulk trade goods.'
        ]);

        // safe
        ItemType::create([
            'name'        => 'Secure storage',
            'description' => 'Secure storage can hold only a little but will prevent the contents from falling into the wrong hands.'
        ]);

        // sensor
        ItemType::create([
            'name'        => 'Sensors',
            'description' => 'Sensors and scanner to detect and analyze whatever you may encounter.'
        ]);
    }
}
