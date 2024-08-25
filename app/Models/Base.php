<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 * 
 * @package namespace App\Models
 */
class Base extends Model
{
    protected $dataFormat = 'm-d-Y H:i:s';

    public function getExcludedColumnsAttribute()
    {
        return [
            'id',
            'modified_by',
            'created_by',
            'deleted_at',
            'created_at',
            'updated_at',
        ];
    }

    public function getDateFormat()
    {
        return $this->dataFormat;
    }
}