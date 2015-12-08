<?php

namespace Stellar\Models\Items;

/**
 * Stellar\Models\Items\CargoPod
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Items\CargoPod whereUpdatedAt($value)
 */
class CargoPod extends Item
{
    public static $category = 'Cargo pods are designed to hold bulk trade goods.';

    /**
     * CargoPod constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->type = 'CargoPod';
    }
}
