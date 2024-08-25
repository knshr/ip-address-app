<?php

namespace App\Transformers\AuditLog;

use App\Models\AuditLog;
use League\Fractal\TransformerAbstract;

/**
 * Class FullInfoTransformer
 * @package namespace App\Transformers\AuditLog
 */
class FullInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the IP Address entity
     * @param AuditLog $model
     * 
     * @return array
     */
    public function transform(AuditLog $model)
    {
        return [
            'event'         => $model->event,
            'old_values'    => $model->old_values,
            'new_values'    => $model->new_values,
            'audited'       => $model->audited->first_name . ' ' . $model->audited->last_name,
            'created_at'    => $model->created_at->toDateTimeString(),
        ];
    }
}