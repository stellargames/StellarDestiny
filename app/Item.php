<?php

namespace Stellar;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';
	public $timestamps = true;

	public function type()
	{
		return $this->belongsTo('Stellar\ItemType');
	}

}

