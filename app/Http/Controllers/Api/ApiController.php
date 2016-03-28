<?php

namespace Stellar\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Contracts\CommandResultInterface;
use Stellar\Http\Controllers\Controller;

class ApiController extends Controller
{

    use AuthenticatesUsers;


    /**
     * Handle incoming request.
     *
     * @param Request                 $request
     *
     * @param CommandHandlerInterface $handler
     *
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request, CommandHandlerInterface $handler)
    {
        $command   = $request->input('command');
        $arguments = $request->input('arguments');
        $result    = $handler->handle($command, $arguments);

        $response = $this->getResponse($result);

        // Mark the response with the requestId.
        if ($request->has('requestId')) {
            $response['requestId'] = $request->input('requestId');
        }

        // Add any data.
        if ($result->hasData()) {
            $response['data'] = $result->getData();
        }

        return response()->json($response);
    }


    public function testForm(Request $request)
    {
        return view('api.testform');
    }


    /**
     * @param CommandResultInterface $result
     *
     * @return array
     */
    protected function getBasicResponse(CommandResultInterface $result)
    {
        $response = [
          'success'    => $result->succeeded(),
          'messages'   => $result->getMessages() ?: [],
          'serverTime' => Carbon::now()->toIso8601String(),
        ];

        return $response;
    }


    /**
     * @return array
     */
    protected function getEmptyResponse()
    {
        $response = [
          'success'    => false,
          'messages'   => ['No result'],
          'serverTime' => Carbon::now()->toIso8601String(),
        ];
        return $response;
    }


    /**
     * @param CommandResultInterface $result
     *
     * @return array
     */
    protected function getResponse(CommandResultInterface $result)
    {
        if ($result === null) {
            return $this->getEmptyResponse();
        }
        return $this->getBasicResponse($result);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $token = Auth::guard($this->getGuard())->attempt($credentials);
        if ($token) {
            return $this->handleUserWasAuthenticated($request, $throttles,
              $token);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    protected function handleUserWasAuthenticated(
      Request $request,
      $throttles,
      $token
    ) {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request,
              Auth::guard($this->getGuard())->user(), $token);
        }

        return redirect()->intended($this->redirectPath());
    }


    protected function authenticated($request, $user, $token)
    {
        return response()->json([
          'user'    => $user,
          'request' => $request->all(),
          'token'   => $token,
        ]);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
          'message'  => $this->getFailedLoginMessage(),
          'username' => $this->loginUsername(),
          'request'  => $request,
        ]);
    }

}
