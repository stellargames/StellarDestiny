<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

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
