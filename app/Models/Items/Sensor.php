<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\Sensor
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Sensor whereUpdatedAt($value)
 */
class Sensor extends Item
{
    public static $category = 'Sensors and scanner to detect and analyze whatever you may encounter.';

    protected static $singleTableType = 'Sensor';
}
