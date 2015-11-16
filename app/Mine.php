<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Mine extends Model {

	protected $table = 'mines';
	public $timestamps = false;

	public function owner()
	{
		return $this->belongsTo('Player');
	}

}