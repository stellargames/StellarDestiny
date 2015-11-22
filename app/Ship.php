<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model {

	protected $table = 'ships';
	public $timestamps = true;

	public function owner()
	{
		return $this->belongsTo('User');
	}

	public function location()
	{
		return $this->belongsTo('Star');
	}

	public function type()
	{
		return $this->belongsTo('ShipType');
	}

	public function items()
	{
		return $this->belongsToMany('Item')->withPivot('amount','paid');
	}

}
