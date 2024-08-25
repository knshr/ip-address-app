<?php

namespace App\Models;

use App\Traits\AuditLog as TraitsAuditLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use TraitsAuditLog;

    protected $table = 'audit_logs';

    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json'
    ];

    public function audited()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
