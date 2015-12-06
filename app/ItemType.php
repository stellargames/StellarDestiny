<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\ItemType
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Item[] $items
 * @method static Builder|ItemType whereId($value)
 * @method static Builder|ItemType whereName($value)
 * @method static Builder|ItemType whereDescription($value)
 * @method static Builder|ItemType whereCreatedAt($value)
 * @method static Builder|ItemType whereUpdatedAt($value)
 */
class ItemType extends Model {

	protected $table = 'item_types';
	public $timestamps = true;

	public function items()
	{
		return $this->hasMany('Stellar\Item');
	}

}
