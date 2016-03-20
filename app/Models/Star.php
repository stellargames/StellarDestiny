<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Star
 *
 * @property integer                                                              $id
 * @property string                                                               $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Star[] $exits
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Star whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Star whereName($value)
 */
class Star extends Model
{

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'stars';

    protected $primaryKey = 'name';

    protected $hidden = [ 'pivot' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];


    /**
     * @param Star $star
     */
    public function linkTo(Star $star) {
        $this->exits()->attach($star);
    }


    /**
     * The stars that can be jumped to from this star.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exits() {
        return $this->belongsToMany('Stellar\Models\Star', 'star_links', 'star_name', 'destination');
    }

}
