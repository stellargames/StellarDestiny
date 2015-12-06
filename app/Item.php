<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Item
 *
 * @property integer $id
 * @property \Stellar\ItemType $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereType($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereValue($value)
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereUpdatedAt($value)
 */
class Item extends Model {

	protected $table = 'items';
	public $timestamps = true;

	public function type()
	{
		return $this->belongsTo('Stellar\ItemType');
	}

}

