<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\Shield
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Shield whereUpdatedAt($value)
 */
class Shield extends Item
{
    public static $category = 'Electromagnetic shields protect your ship from damage. It is more effective against beam weapons than kinetic weapons.';

    protected static $singleTableType = 'Shield';
}
