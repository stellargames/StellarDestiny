<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('ItemTableSeeder');
        $this->call('ShipTypeTableSeeder');

        Model::reguard();
    }
}
