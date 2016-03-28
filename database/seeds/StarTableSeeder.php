<?php

use Illuminate\Database\Seeder;
use Stellar\Repositories\Contracts\StarRepositoryInterface;

class StarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stars')->delete();
        DB::table('star_links')->delete();

        $galaxy = app()->make('StarRepository');
        $galaxy->createNew($galaxy::GALAXY_LARGE);
        
    }
}
