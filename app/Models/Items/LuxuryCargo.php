<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\LuxuryCargo
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\LuxuryCargo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LuxuryCargo extends Item
{

    public static $category = 'Luxury Cargo is made up of exotic foodstuffs, art, jewelry, fashion etc.';

    protected static $singleTableType = 'Luxury Cargo';
}
