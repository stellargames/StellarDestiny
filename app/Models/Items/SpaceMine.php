<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\SpaceMine
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SpaceMine whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SpaceMine extends Item
{

    public static $category = 'Space mines are a cheap way to limit rival movements.';

    protected static $singleTableType = 'Space Mine';
}
