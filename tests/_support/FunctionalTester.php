<?php

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
class FunctionalTester extends \Codeception\Actor
{

    use _generated\FunctionalTesterActions;

    /**
     * Define custom actions here
     */

    /**
     * Asserts that a function throws an exception.
     *
     * @param Closure $callback
     * @param string  $exception
     * @param string  $message
     */
    public function seeException($exception, $callback, $message = null)
    {
        $function = function () use ($callback, $exception) {
            $getAncestors = function ($e) {
                $classes = [];
                do {
                    $classes[] = $e;
                    $e         = get_parent_class($e);
                } while ($e);
                return $classes;
            };
            try {
                $callback();
                return false;
            } catch (Exception $e) {
                return (get_class($e) === $exception || in_array($e, $getAncestors($e), true));
            }
        };
        if ($message === null) {
            $message = 'Expected ' . $exception . ' was not thrown.';
        }
        $this->assertTrue($function(), $message);
    }
}
