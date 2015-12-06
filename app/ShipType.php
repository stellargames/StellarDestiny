<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\ShipType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $slots
 * @property integer $structure
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|ShipType whereId($value)
 * @method static Builder|ShipType whereName($value)
 * @method static Builder|ShipType whereDescription($value)
 * @method static Builder|ShipType whereSlots($value)
 * @method static Builder|ShipType whereStructure($value)
 * @method static Builder|ShipType whereCreatedAt($value)
 * @method static Builder|ShipType whereUpdatedAt($value)
 */
class ShipType extends Model {

	protected $table = 'ship_types';
	public $timestamps = true;


}
