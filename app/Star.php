<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Star extends Model {

	protected $table = 'stars';
	public $timestamps = true;

	public function traders()
	{
		return $this->hasMany('Stellar/Trader');
	}

	public function ships()
	{
		return $this->hasMany('Stellar/Ship');
	}

	public function exits()
	{
		return $this->belongsToMany('Stellar/Star', 'star_links', 'star_id', 'destination')->withTimeStamps();
	}

	public function mines()
	{
		return $this->hasMany('Stellar/Mine');
	}

}
