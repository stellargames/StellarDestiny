<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\BeamWeapon
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\BeamWeapon whereUpdatedAt($value)
 */
class BeamWeapon extends Item
{
    public static $category = 'Beam weapons can damage other ships. They are not very effective against electromagnetic shields though.';

    protected static $singleTableType = 'Beam Weapon';
}
