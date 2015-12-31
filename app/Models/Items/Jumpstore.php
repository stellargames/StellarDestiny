<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\JumpStore
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\JumpStore whereUpdatedAt($value)
 */
class JumpStore extends Item
{

    public static $category = 'Jump stores are energy storage devices that power the jumps through the starlinks.';

    protected static $singleTableType = 'JumpStore';

}
