<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Star
 *
 * @property integer $id
 * @property string $name
 * @property-read Collection|\Stellar\Trader[] $traders
 * @property-read Collection|\Stellar\Ship[] $ships
 * @property-read Collection|Star[] $exits
 * @property-read Collection|\Stellar\Mine[] $mines
 * @method static Builder|Star whereId($value)
 * @method static Builder|Star whereName($value)
 */
class Star extends Model
{

    protected $table = 'stars';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];


    /**
     * The traders that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traders()
    {
        return $this->hasMany('Stellar\Trader');
    }


    /**
     * The ships that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ships()
    {
        return $this->hasMany('Stellar\Ship');
    }


    /**
     * The stars that can be jumped to from this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exits()
    {
        return $this->belongsToMany('Stellar\Star', 'star_links', 'star_id', 'destination');
    }


    /**
     * The mines that are present at this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mines()
    {
        return $this->hasMany('Stellar\Mine');
    }

}
