<?php

use Illuminate\Database\Seeder;
use Stellar\Models\ShipType;

class ShipTypeTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ship_types')->delete();

        ShipType::create(
            [
                'name'        => 'Explorer',
                'description' => 'The most basic ship available. With limited cargo storage and no weapons.',
                'slots'       => 10,
                'structure'   => 100,
            ]
        );

    }
}
