<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Faction
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Faction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Faction whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Faction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Faction whereUpdatedAt($value)
 */
class Faction extends Model
{

    protected $table = 'factions';

    public $timestamps = true;


    public function users()
    {
        return $this->hasMany('Stellar\Models\User');
    }

}
