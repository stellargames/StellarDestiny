<?php

use Illuminate\Database\Seeder;
use Stellar\Models\Items\CargoPod;
use Stellar\Models\Items\JumpStore;

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
        CargoPod::create([
            'name'        => 'Easy Hold Basic',
            'description' => 'A simple basic cargo storage container.',
            'value'       => 1
        ]);
    }
}
