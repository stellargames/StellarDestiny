<?php

use Illuminate\Database\Seeder;
use Stellar\Models\Items\Jumpstore;

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
        Jumpstore::create([
            'name'        => 'Shocking Watt Pack',
            'description' => 'A simple basic jump energy store.',
            'value'       => 1
        ]);
    }
}
