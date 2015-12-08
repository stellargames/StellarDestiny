<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Trader
 *
 * @property integer $id
 * @property integer $star_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Stellar\Models\Star $star
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Items\Item[] $items
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Trader whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Trader whereStarId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Trader whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Trader whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Trader whereUpdatedAt($value)
 */
class Trader extends Model {

	protected $table = 'traders';
	public $timestamps = true;

	public function star()
	{
		return $this->belongsTo('Stellar\Models\Star');
	}

	public function items()
	{
		return $this->belongsToMany('Stellar\Models\Items\Item')->withPivot('amount', 'wanted', 'balance');
	}

}
