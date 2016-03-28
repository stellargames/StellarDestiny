<?php

class StarGeneratorCest
{

    public function _before(FunctionalTester $I) {
        $email = 'admin+' . str_random(8) . '@stellardestiny.online';
        $I->haveRecord(
            'users', [
            'name'       => 'admin',
            'email'      => $email,
            'status'     => \Stellar\Models\User::ADMIN,
            'password'   => bcrypt('password'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]
        );
        $I->amLoggedAs([ 'email' => $email, 'password' => 'password' ]);
    }


    public function _after(FunctionalTester $I) {
    }


    // tests
    public function generateStars(FunctionalTester $I) {
        $amount = 123;
        $I->amOnPage('/admin/star');
        $I->see('Star administration');
        $I->click('Generate new galaxy.');
        $I->fillField('amount', $amount);
        $I->click('Generate');
        $starCount = $I->grabTextFrom('~<li>Star count: (\d+)</li>~');
        $I->assertEquals($amount, $starCount);
    }
}
