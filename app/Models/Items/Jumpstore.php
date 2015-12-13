<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\Jumpstore
 *
 * @property integer        $id
 * @property string         $type
 * @property string         $name
 * @property string         $description
 * @property integer        $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereType( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereDescription( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereValue( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\Jumpstore whereUpdatedAt( $value )
 */
class Jumpstore extends Item
{

    protected static $singleTableType = 'Jumpstore';

    public static $category = 'Jumpstores are energy storage devices that power the jumps through the starlinks.';

}
