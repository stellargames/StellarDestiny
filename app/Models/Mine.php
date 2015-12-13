<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Mine
 *
 * @property integer $star_id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $trigger
 * @property-read \Stellar\Models\User $owner
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Mine whereStarId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Mine whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Mine whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Mine whereTrigger($value)
 */
class Mine extends Model
{

    protected $table = 'mines';

    public $timestamps = false;


    public function owner()
    {
        return $this->belongsTo('Stellar\Models\User');
    }

}
