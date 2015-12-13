<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Star
 *
 * @property integer                                                                $id
 * @property string                                                                 $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Trader[] $traders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Ship[]   $ships
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Star[]   $exits
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Mine[]   $mines
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Star whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Star whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Star random()
 */
class Star extends Model
{

    protected $table = 'stars';

    public $timestamps = false;

    protected $hidden = [ 'pivot' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];


    public function scopeRandom($query)
    {
        $totalRows = static::count() - 1;
        $skip      = $totalRows > 0 ? mt_rand(0, $totalRows) : 0;

        return $query->skip($skip)->take(1);
    }


    /**
     * The traders that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traders()
    {
        return $this->hasMany('Stellar\Models\Trader');
    }


    /**
     * The ships that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ships()
    {
        return $this->hasMany('Stellar\Models\Ship');
    }


    /**
     * The stars that can be jumped to from this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exits()
    {
        return $this->belongsToMany('Stellar\Models\Star', 'star_links', 'star_id', 'destination');
    }


    /**
     * The mines that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mines()
    {
        return $this->hasMany('Stellar\Models\Mine');
    }


    /**
     * Find a starting star for a new player.
     *
     * @return Star
     */
    public static function findStartLocation()
    {
        // @TODO: Write some algorithm to start new players in a relatively safe part of the galaxy.
        return self::random()->first();
    }
}
