<?php

namespace Stellar;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;

define ('USER_STATUS_REGISTERED', 0);
define ('USER_STATUS_ADMIN', 1);
define ('USER_STATUS_SPAMMER', 2);


/**
 * Class User
 *
 * @package Stellar
 * @property int    $status
 * @property string $name
 * @property integer $id
 * @property integer $faction_id
 * @property integer $reputation
 * @property integer $alignment
 * @property integer $affiliation
 * @property integer $current_ship
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Ship[] $ships
 * @property-read \Stellar\Faction $faction
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereFactionId($value)
 * @method static Builder|User whereReputation($value)
 * @method static Builder|User whereAlignment($value)
 * @method static Builder|User whereAffiliation($value)
 * @method static Builder|User whereCurrentShip($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'users';

    public $timestamps = true;

    public static $statusEnum = [
        USER_STATUS_REGISTERED => 'Registered',
        USER_STATUS_ADMIN => 'Admin',
        USER_STATUS_SPAMMER => 'Spammer',
    ];

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
        return $this->hasMany('Stellar\Ship');
    }


    /**
     * The faction the player belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faction()
    {
        return $this->belongsTo('Stellar\Faction');
    }


    /**
     * Check if this user has a role.
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        $bit = array_search($role, $this::$statusEnum);
        $has_role = $bit && $this->status & $bit == 1;
        return $has_role;
    }


    /**
     * Check if the user is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

}
