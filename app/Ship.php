<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model {

	protected $table = 'ships';
	public $timestamps = true;

	public function owner()
	{
		return $this->belongsTo('Stellar/User');
	}

	public function location()
	{
		return $this->belongsTo('Stellar/Star');
	}

	public function type()
	{
		return $this->belongsTo('Stellar/ShipType');
	}

	public function items()
	{
		return $this->belongsToMany('Stellar/Item')->withPivot('amount','paid');
	}

}
