<?php

class RegistrationCest
{

    private $tester;


    public function _before(FunctionalTester $I)
    {
        $this->tester = [
            'name'       => 'Tester',
            'email'      => 'tester@stellardestiny.online',
            'password'   => 'password',
        ];

        $I->amOnPage('/');
        $I->click('Register');
        $I->seeCurrentUrlEquals('/auth/register');
    }


    public function testRequiredFields(FunctionalTester $I)
    {
        $I->click('Register', 'button');
        $I->seeFormErrorMessages([
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);
    }


    public function testPasswordMismatch(FunctionalTester $I)
    {
        $I->fillField('password', $this->tester['password']);
        $I->fillField('password_confirmation', 'garbage');
        $I->click('Register', 'button');
        $I->seeFormErrorMessage('password', 'match');
    }


    public function testInvalidEmail(FunctionalTester $I)
    {
        $I->fillField('email', 'garbage');
        $I->click('Register', 'button');
        $I->seeFormErrorMessage('email', 'must be a valid email address');
    }


    public function testDuplicateEmail(FunctionalTester $I)
    {
        $I->haveRecord('users', [
            'email' => $this->tester['email'],
        ]);
        $I->fillField('email', $this->tester['email']);
        $I->click('Register', 'button');
        $I->seeFormErrorMessage('email', 'already been taken');
    }


    public function testValidRegistration(FunctionalTester $I)
    {
        $I->fillField('name', $this->tester['name']);
        $I->fillField('email', $this->tester['email']);
        $I->fillField('password', $this->tester['password']);
        $I->fillField('password_confirmation', $this->tester['password']);
        $I->click('Register', 'button');
        $I->dontSeeFormErrors();
        $I->seeRecord('users', [
            'name'  => $this->tester['name'],
            'email' => $this->tester['email'],
        ]);
        $I->seeAuthentication();
    }

    public function testSpamRegistration(FunctionalTester $I)
    {
        $I->fillField('name', $this->tester['name']);
        $I->fillField('email', $this->tester['email']);
        $I->fillField('password', $this->tester['password']);
        $I->fillField('password_confirmation', $this->tester['password']);
        $I->fillField('agreement', 'yes');
        $I->click('Register', 'button');
        $I->dontSeeFormErrors();
        $I->click('Logout');
        $I->click('Login');
        $I->fillField('email', $this->tester['email']);
        $I->fillField('password', $this->tester['password']);
        $I->click('Login', 'button');
        $I->seeFormHasErrors();
        $I->dontSeeAuthentication();
    }

}
