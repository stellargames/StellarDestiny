<?php

namespace Stellar\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Stellar\Http\Controllers\Controller;
use Stellar\Models\User;

class ApiAuthController extends Controller
{

    use AuthenticatesUsers;

    protected $guard = 'api';


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
            return $this->handleUserWasAuthenticated($request, $throttles, $token);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param  bool                    $throttles
     * @param  string                  $token
     *
     * @return mixed
     */
    protected function handleUserWasAuthenticated(
      Request $request,
      $throttles,
      $token
    ) {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user(), $token);
        }

        return redirect()->intended($this->redirectPath());
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     * @param string                   $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticated(Request $request, $user, $token)
    {
        $identifier = $this->loginUsername();
        $response   = [
          'success'    => true,
          'messages'   => [],
          'serverTime' => Carbon::now()->toIso8601String(),
          'data'       => [
            $identifier => $user->$identifier,
            'token'     => $token,
          ],
        ];

        return response()->json($response);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $response = [
          'success'    => false,
          'messages'   => [$this->getFailedLoginMessage()],
          'serverTime' => Carbon::now()->toIso8601String(),
        ];

        return response()->json($response);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $this->create($request->all());

        $credentials = [
          'username' => $request['username'],
          'password' => $request['password'],
        ];

        $token = Auth::guard($this->getGuard())->attempt($credentials);

        return response()->json(['token' => $token]);
    }
}
