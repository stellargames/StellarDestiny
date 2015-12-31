<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\Armor
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Armor whereUpdatedAt($value)
 */
class Armor extends Item
{

    public static $category = 'Armor plating protects your ship from damage. It is more effective against kinetic weapons than beam weapons.';

    protected static $singleTableType = 'Armor';

}
