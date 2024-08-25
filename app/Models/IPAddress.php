<?php

namespace App\Models;

use App\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IPAddress extends Model
{
    use SoftDeletes,HasFactory,
    UserAudit {
        UserAudit::runSoftDelete insteadof SoftDeletes;
    }

    protected $table = 'ip_addresses';

    protected $guarded = [
        'id',
        'deleted_at',
        'created_by',
        'modified_by'
    ];

    protected $casts = [
        'ip_address' => 'string',
        'label' => 'string'
    ];
}
