<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Ship
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
 * @property-read \Stellar\Models\User $owner
 * @property-read \Stellar\Models\Star $location
 * @property-read \Stellar\Models\ShipType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Items\Item[] $items
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStarId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereShipTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereEnergy($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStructure($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCredits($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUpdatedAt($value)
 */
class Ship extends Model {

	protected $table = 'ships';
	public $timestamps = true;


	/**
	 * Ship constructor.
	 *
	 * @param ShipType $type
	 * @param User     $owner
	 * @param Star     $location
	 * @param string   $name
	 */
	public function __construct(ShipType $type, User $owner, Star $location, $name = '')
	{
		parent::__construct();
		$this->type()->associate($type);
		$this->owner()->associate($owner);
        $this->location()->associate($location);
        $this->name = $name;
	}


	public function owner()
	{
		return $this->belongsTo('Stellar\Models\User', 'user_id');
	}

	public function location()
	{
		return $this->belongsTo('Stellar\Models\Star', 'star_id');
	}

	public function type()
	{
		return $this->belongsTo('Stellar\Models\ShipType', 'ship_type_id');
	}

	public function items()
	{
		return $this->belongsToMany('Stellar\Models\Items\Item')->withPivot('amount','paid');
	}

}
