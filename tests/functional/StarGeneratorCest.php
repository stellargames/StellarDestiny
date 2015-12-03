<?php

class StarGeneratorCest
{
    public function _before(FunctionalTester $I)
    {
        $email = 'admin+' . str_random(8) . '@stellardestiny.online';
        $I->haveRecord('users', [
            'name' =>  'admin',
            'email' =>  $email,
            'status' => 1,
            'password' => bcrypt('password'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->amLoggedAs(['email' => $email, 'password' => 'password']);
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function generateStars(FunctionalTester $I)
    {
        $I->amOnPage('/admin/star');
        $I->see('Star administration');
        $star_count_before = $I->grabTextFrom('~<li>Star count: (\d+)</li>~');
        $star_link_count_before = $I->grabTextFrom('~<li>Star link count: (\d+)</li>~');
        $I->click('Generate new galaxy.');
        $star_count_after = $I->grabTextFrom('~<li>Star count: (\d+)</li>~');
        $star_link_count_after = $I->grabTextFrom('~<li>Star link count: (\d+)</li>~');
        $I->assertGreaterThan($star_count_before, $star_count_after);
        $I->assertGreaterThan($star_link_count_before, $star_link_count_after);
    }
}
