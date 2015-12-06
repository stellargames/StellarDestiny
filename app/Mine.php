<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Mine
 *
 * @property integer $star_id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $trigger
 * @property-read \Stellar\User $owner
 * @method static Builder|Mine whereStarId($value)
 * @method static Builder|Mine whereUserId($value)
 * @method static Builder|Mine whereItemId($value)
 * @method static Builder|Mine whereTrigger($value)
 */
class Mine extends Model {

	protected $table = 'mines';
	public $timestamps = false;

	public function owner()
	{
		return $this->belongsTo('Stellar\User');
	}

}
