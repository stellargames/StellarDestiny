<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Stellar\Models\User;

$factory->define(Stellar\Models\User::class, function (Faker\Generator $faker) {
    return [
      'name'           => $faker->name,
      'email'          => $faker->safeEmail,
      'password'       => bcrypt(str_random(10)),
      'status'         => User::REGISTERED,
      'remember_token' => str_random(10),
    ];
});

$factory->defineAs(Stellar\Models\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(Stellar\Models\User::class);

    return array_merge($user, ['status' => User::ADMIN]);
});
