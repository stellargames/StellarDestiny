<?php 
$I = new ApiTester($scenario);
$I->wantTo('authenticate with the api');
$I->haveModel(\Stellar\Models\User::class, [
  'name'       => 'John Doe',
  'email'      => 'john@doe.com',
  'status'     => \Stellar\Models\User::REGISTERED,
  'password'   => bcrypt('password'),
]);
$I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"success":true');

