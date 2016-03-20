<?php

namespace Stellar\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Stellar\Http\Controllers\Controller;
use Validator;

class PasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';


    /**
     * Create a new password controller instance.
     *
     */
    public function __construct() {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make(
            $data, [
                'token'    => 'required',
                'email'    => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]
        );
    }


    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * 
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function postReset(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $response = Password::reset(
            $credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        if ($response === Password::PASSWORD_RESET) {
            return redirect($this->redirectPath())->with('status', trans($response));
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors(
                [ 'email' => trans($response) ]
            );
        }
    }
}
