<?php
use Stellar\Models\User;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiTester extends \Codeception\Actor
{

    use _generated\ApiTesterActions;

    /**
     * Define custom actions here
     */

    /**
     * Creates and logs in a player.
     */
    public function amAuthenticated()
    {
        $I = $this;
        // Log in to get a token.
        $I->haveModel(User::class, [
          'name'     => 'John Doe',
          'email'    => 'john@doe.com',
          'status'   => User::REGISTERED,
          'password' => bcrypt('password'),
        ]);
        $I->sendPOST('login', ['email' => 'john@doe.com', 'password' => 'password']);
        $token = $I->grabDataFromResponseByJsonPath("$['data']['token']");
        $I->amBearerAuthenticated($token[0]);
        $I->haveHttpHeader('Accept', 'application/json');
    }

}
