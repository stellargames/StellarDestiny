<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model {

	protected $table = 'item_types';
	public $timestamps = true;

	public function items()
	{
		return $this->hasMany('Stellar\Item');
	}

}
