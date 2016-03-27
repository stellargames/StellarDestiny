<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\BiologyCargo
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BiologyCargo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BiologyCargo extends Item
{

    public static $category = 'Biology Cargo consists of plants, animals, organic materials and other biologicals.';

    protected static $singleTableType = 'Biology Cargo';
}
