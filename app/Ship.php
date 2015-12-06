<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Ship
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $star_id
 * @property integer $ship_type_id
 * @property integer $energy
 * @property integer $structure
 * @property integer $credits
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Stellar\User $owner
 * @property-read \Stellar\Star $location
 * @property-read \Stellar\ShipType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Item[] $items
 * @method static Builder|Ship whereId($value)
 * @method static Builder|Ship whereUserId($value)
 * @method static Builder|Ship whereStarId($value)
 * @method static Builder|Ship whereShipTypeId($value)
 * @method static Builder|Ship whereEnergy($value)
 * @method static Builder|Ship whereStructure($value)
 * @method static Builder|Ship whereCredits($value)
 * @method static Builder|Ship whereName($value)
 * @method static Builder|Ship whereCreatedAt($value)
 * @method static Builder|Ship whereUpdatedAt($value)
 */
class Ship extends Model {

	protected $table = 'ships';
	public $timestamps = true;

	public function owner()
	{
		return $this->belongsTo('Stellar\User');
	}

	public function location()
	{
		return $this->belongsTo('Stellar\Star');
	}

	public function type()
	{
		return $this->belongsTo('Stellar\ShipType');
	}

	public function items()
	{
		return $this->belongsToMany('Stellar\Item')->withPivot('amount','paid');
	}

}
