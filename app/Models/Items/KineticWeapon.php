<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\KineticWeapon
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\KineticWeapon whereUpdatedAt($value)
 */
class KineticWeapon extends Item
{
    public static $category = 'Kinetic weapons can damage other ships. They are not very effective against armor plating though.';

    protected static $singleTableType = 'Kinetic Weapon';
}
