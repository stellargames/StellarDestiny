<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\TechnologyCargo
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\TechnologyCargo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TechnologyCargo extends Item
{

    public static $category = 'Technology Cargo holds electronics, AI cores, exotic materials and other hardware.';

    protected static $singleTableType = 'Technology Cargo';
}
