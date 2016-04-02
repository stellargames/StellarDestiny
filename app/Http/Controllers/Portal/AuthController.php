<?php

namespace Stellar\Http\Controllers\Portal;

use Event;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Stellar\Events\UserRegistered;
use Stellar\Http\Controllers\Controller;
use Stellar\Models\User;
use Validator;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';


    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'name'     => 'required|max:64',
          'email'    => 'required|email|max:255|unique:users',
          'password' => 'required|min:8|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        // Agreement is the honeypot field. Append it to the password so that bots can register but never log in.
        $user = new User([
          'name'     => $data['name'],
          'email'    => $data['email'],
          'password' => bcrypt($data['password'] . $data['agreement']),
        ]);
        // Also mark user as spammer when agreement is filled.
        if (!empty($data['agreement'])) {
            $user->status |= $user::SPAMMER;
        }
        $user->save();
        Event::fire(new UserRegistered($user));

        return $user;
    }
}
