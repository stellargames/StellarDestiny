<?php
$I = new FunctionalTester($scenario);
$I->wantTo('login as an administrator');
$I->haveRecord('users', [
    'name' =>  'Ad Min',
    'email' =>  'admintester@admin.tester',
    'password' => bcrypt('password'),
    'status' => 1,
    'created_at' => new DateTime(),
    'updated_at' => new DateTime(),
]);

$I->amOnPage('/auth/login');
$I->fillField('email', 'admintester@admin.tester');
$I->fillField('password', 'password');
$I->click('button[type=submit]');
$I->seeCurrentUrlEquals('');
$I->seeAuthentication();
$I->see('Logged in as Ad Min');
$I->see('Admin');

$I->click('Users');
$I->seeResponseCodeIs(200);

$I->click('Logout');
$I->dontSeeAuthentication();

