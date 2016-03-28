<?php

namespace Stellar\Http\Controllers\Portal;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Stellar\Http\Controllers\Controller;

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
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function getResetValidationRules()
    {
        return [
          'token'    => 'required',
          'email'    => 'required|email',
          'password' => 'required|min:8|confirmed',
        ];
    }

}
