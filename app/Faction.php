<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Faction
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\User[] $users
 * @method static Builder|Faction whereId($value)
 * @method static Builder|Faction whereName($value)
 * @method static Builder|Faction whereCreatedAt($value)
 * @method static Builder|Faction whereUpdatedAt($value)
 */
class Faction extends Model {

	protected $table = 'factions';
	public $timestamps = true;

	public function users()
	{
		return $this->hasMany('Stellar\User');
	}

}
