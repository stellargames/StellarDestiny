<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\SecureStorage
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\SecureStorage whereUpdatedAt($value)
 */
class SecureStorage extends Item
{

    public static $category = 'Secure storage can hold only a little but will prevent the contents from falling into the wrong hands.';

    protected static $singleTableType = 'Secure Storage';
}
