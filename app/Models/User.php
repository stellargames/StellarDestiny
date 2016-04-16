<?php

namespace Stellar\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Stellar\Api\Contracts\PlayerInterface;
//use Stellar\ShipFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject, PlayerInterface
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
        //$ship = ShipFactory::getStartingShip($this);
        //// Make the ship belong to the player.
        //$this->current_ship = $ship->id;
        //$this->save();
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


    /**
     * Get the name of the player.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Get the reputation of the player.
     *
     * This represents the "level" or status of the player.
     *
     * @return int
     */
    public function getReputation()
    {
        return $this->reputation;
    }


    /**
     * Get the alignment of the player.
     *
     * An alignment of 0 is neutral, a positive alignment represents good, a negative alignment evil.
     * This is adjusted based on the actions of the player and can affect reactions of others.
     *
     * @return int
     */
    public function getAlignment()
    {
        return $this->alignment;
    }


    /**
     * Get the affiliation of the player.
     *
     * This represents the balance between nature and technology.
     * Negative is associated with technology and positive with nature.
     *
     * @return int
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }


    /**
     * Get the ship the player is currently using.
     *
     * @return \Stellar\Api\Contracts\ShipInterface
     */
    public function getShip()
    {
        return $this->ship();
    }


    /**
     * Get all the ships the player owns.
     *
     * @return array
     */
    public function getShips()
    {
        return $this->ships()->flatten();
    }
}
