<?php

namespace App\Transformers\IPAddress;

use App\Models\IPAddress;
use League\Fractal\TransformerAbstract;

/**
 * Class FullInfoTransformer
 * @package namespace App\Transformers\IPAddress
 */
class FullInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the IP Address entity
     * @param IPAddress $model
     * 
     * @return array
     */
    public function transform(IPAddress $model)
    {
        return [
            'id'            => $model->id,
            'ip_address'    => $model->ip_address,
            'label'         => $model->label
        ];
    }
}