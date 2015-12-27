<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\ShipType
 *
 * @property integer        $id
 * @property string         $name
 * @property string         $description
 * @property integer        $slots
 * @property integer        $structure
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereDescription( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereSlots( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereStructure( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\ShipType whereUpdatedAt( $value )
 */
class ShipType extends Model
{

    protected $table = 'ship_types';

    public $timestamps = true;

    public $hidden = ['id', 'created_at', 'updated_at'];

}
