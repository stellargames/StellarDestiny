<?php

namespace Stellar\Models\Items;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

/**
 * Stellar\Models\Items\Item
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Item whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Item extends Model
{

    use SingleTableInheritanceTrait;

    protected static $singleTableTypeField = 'type';

    protected static $singleTableSubclasses = [
      BiologyCargo::class,
      TechnologyCargo::class,
      LuxuryCargo::class,
      Armor::class,
      Shield::class,
      BeamWeapon::class,
      KineticWeapon::class,
      JumpStore::class,
      SpaceMine::class,
      SecureStorage::class,
      Sensor::class,

    ];

    public $timestamps = true;

    protected $table = 'items';

    protected $hidden = ['created_at', 'updated_at'];

}

