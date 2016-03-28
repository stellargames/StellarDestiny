<?php

namespace Stellar\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Stellar\ShipFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Stellar\Models\User
 *
 * @property integer
 *             $id
 * @property string
 *             $name
 * @property boolean
 *             $status
 * @property integer
 *             $faction_id
 * @property integer
 *             $reputation
 * @property integer
 *             $alignment
 * @property integer
 *             $affiliation
 * @property integer
 *             $current_ship
 * @property string
 *             $email
 * @property string
 *             $password
 * @property string
 *             $remember_token
 * @property \Carbon\Carbon
 *             $created_at
 * @property \Carbon\Carbon
 *             $updated_at
 * @property-read \Stellar\Models\Ship
 *                  $ship
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Ship[]
 *                $ships
 * @property-read \Stellar\Models\Faction
 *                  $faction
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereFactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereReputation($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereAlignment($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereAffiliation($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereCurrentShip($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\User
 *         whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{

    use Authenticatable, Authorizable, CanResetPassword;

    const REGISTERED = 1;
    const ADMIN = 2;
    const SPAMMER = 4;
    const STATUS_ENUM = [
      self::REGISTERED => 'Registered',
      self::ADMIN      => 'Admin',
      self::SPAMMER    => 'Spammer',
    ];

    protected $table = 'users';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
      'current_ship',
      'faction_id',
      'email',
      'password',
      'remember_token',
      'created_at',
      'updated_at',
    ];


    /**
     * The current ship this player is on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ship()
    {
        return $this->belongsTo('Stellar\Models\Ship', 'current_ship');
    }


    /**
     * The ships this player has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ships()
    {
        return $this->hasMany('Stellar\Models\Ship');
    }


    /**
     * The faction the player belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faction()
    {
        return $this->belongsTo('Stellar\Models\Faction');
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
        $bit     = array_search($role, $this::STATUS_ENUM, false);
        $matches = $this->status & $bit;

        return $bit && $matches;
    }


    /**
     * Check if the user is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(self::STATUS_ENUM[self::ADMIN]);
    }


    public function isPlayer()
    {
        if ($this->isAdmin()) {
            return false;
        }
        if ($this->hasRole(self::STATUS_ENUM[self::SPAMMER])) {
            return false;
        }

        return true;
    }


    /**
     * Attach a basic starter ship to the player.
     */
    public function setStartingShip()
    {
        $ship = ShipFactory::getStartingShip($this);
        // Make the ship belong to the player.
        $this->current_ship = $ship->id;
        $this->save();
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to
     * the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
