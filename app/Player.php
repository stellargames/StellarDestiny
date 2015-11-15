<?php

namespace Stellar;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class Player
 * @package Stellar
 *
 * @property int $status
 * @property string $name
 */
class Player extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'players';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];


    /**
     * The ships this player has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ships()
    {
        return $this->hasMany('Ship');
    }


    /**
     * Check if this user has a role.
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role) {
        switch ($role) {
            case 'admin':
                $has_role = $this->status == 1;
                break;
            default:
                $has_role = FALSE;
        }
        return $has_role;
    }

}