<?php

use Illuminate\Database\Seeder;
use Stellar\Events\UserRegistered;
use Stellar\Models\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            [
                'name'     => 'admin',
                'status'   => USER_STATUS_ADMIN,
                'email'    => 'admin@stellardestiny.online',
                'password' => '$2y$10$pHhnHCu.EvVEJDlYVAYnkeEb8JUTb4c1MoaKw9z7Tf18bP87Y52JC',
            ]
        );

        $user = User::create(
            [
                'name'     => 'tester',
                'status'   => USER_STATUS_REGISTERED,
                'email'    => 'tester@stellardestiny.online',
                'password' => '$2y$10$pHhnHCu.EvVEJDlYVAYnkeEb8JUTb4c1MoaKw9z7Tf18bP87Y52JC',
            ]
        );
        Event::fire(new UserRegistered($user));
    }
}
