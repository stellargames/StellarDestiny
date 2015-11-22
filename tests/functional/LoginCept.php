<?php
$I = new FunctionalTester($scenario);
$I->wantTo('login as a player');
$I->haveRecord('players', [
    'name' =>  'John Doe',
    'email' =>  'john@doe.com',
    'password' => bcrypt('password'),
    'created_at' => new DateTime(),
    'updated_at' => new DateTime(),
]);

$I->amOnPage('/auth/login');
$I->fillField('email', 'john@doe.com');
$I->fillField('password', 'password');
$I->click('button[type=submit]');
$I->seeCurrentUrlEquals('');
$I->seeAuthentication();
$I->see('Logged in as John Doe');

$I->amOnPage('/admin/player');
$I->seeResponseCodeIs(403);

$I->amOnPage('/');
$I->click('Logout');
$I->dontSeeAuthentication();

