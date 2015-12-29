<?php

use Illuminate\Database\Seeder;
use Stellar\Models\Items\BiologyCargo;
use Stellar\Models\Items\JumpStore;
use Stellar\Models\Items\LuxuryCargo;
use Stellar\Models\Items\TechnologyCargo;

class ItemTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear out old items.
        DB::table('items')->delete();

        // Create new ones.
        JumpStore::create([
            'name'        => 'Shocking Watt Pack',
            'description' => 'A simple basic jump energy store.',
            'value'       => 1
        ]);
        BiologyCargo::create([
            'name'        => 'Biology Cargo',
            'description' => 'A simple cargo storage container filled with biologicals.',
            'value'       => 1
        ]);
        TechnologyCargo::create([
            'name'        => 'Technology Cargo',
            'description' => 'A simple cargo storage container filled with high technology.',
            'value'       => 1
        ]);
        LuxuryCargo::create([
            'name'        => 'Luxury Cargo',
            'description' => 'A simple cargo storage container filled with luxury items.',
            'value'       => 1
        ]);
    }
}
