<?php
use Stellar\Events\UserRegistered;

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
        $user = factory(Stellar\Models\User::class)->create(['password' => bcrypt('password')]);
        Event::fire(new UserRegistered($user));
        $I->sendPOST('login', ['email' => $user->email, 'password' => 'password']);
        $token = $I->grabDataFromResponseByJsonPath("$['data']['token']");
        $I->amBearerAuthenticated($token[0]);
        $I->haveHttpHeader('Accept', 'application/json');
    }

}
