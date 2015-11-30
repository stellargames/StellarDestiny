<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Faction extends Model {

	protected $table = 'factions';
	public $timestamps = true;

	public function users()
	{
		return $this->hasMany('Stellar\User');
	}

}
