<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Stellar\Trader
 *
 * @property integer $id
 * @property integer $star_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Stellar\Star $star
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Item[] $items
 * @method static Builder|Trader whereId($value)
 * @method static Builder|Trader whereStarId($value)
 * @method static Builder|Trader whereName($value)
 * @method static Builder|Trader whereCreatedAt($value)
 * @method static Builder|Trader whereUpdatedAt($value)
 */
class Trader extends Model {

	protected $table = 'traders';
	public $timestamps = true;

	public function star()
	{
		return $this->belongsTo('Stellar\Star');
	}

	public function items()
	{
		return $this->belongsToMany('Stellar\Item')->withPivot('amount', 'wanted', 'balance');
	}

}
