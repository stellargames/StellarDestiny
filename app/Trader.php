<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model {

	protected $table = 'traders';
	public $timestamps = true;

	public function star()
	{
		return $this->belongsTo('Star');
	}

	public function items()
	{
		return $this->belongsToMany('Item')->withPivot('amount', 'wanted', 'balance');
	}

}
