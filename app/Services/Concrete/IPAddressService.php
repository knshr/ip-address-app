<?php

namespace App\Services\Concrete;

use App\Models\IPAddress;
use App\Traits\DatabaseTransaction;
use App\Traits\AuditLog;
use App\Services\Contracts\IPAddressServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class IPAddressService implements IPAddressServiceInterface
{
    use DatabaseTransaction, AuditLog;

    /**
     * Create a new IP Address Record in the database
     * 
     * @param object $attributes
     * @return mixed
     */
    public function store(array $attributes)
    {
        $that = $this;

        return $this->transaction(function () use ($attributes, $that) {
            $attributes = $that->only($attributes);

            $query = IPAddress::create($attributes);

            $this->setAuditableKeyType($query->id,'ip_addresses')->toAudit([
                'old' => [],
                'new' => $attributes,
            ], 'created');

            return $query;
        });
    }

    public function update(array $attributes, $id)
    {
        $that = $this;

        return $this->transaction(function () use ($attributes, $that, $id) {
            $attributes = $that->only($attributes);

            $query = IPAddress::find($id);

            $this->setAuditableKeyType($query->id,'ip_addresses')->toAudit([
                'old' => $query,
                'new' => $attributes,
            ], 'modified');

            $query->fill($attributes)->save();

            return $query;
        });
    }

    /**
     * Filtering values
     * 
     * @param object $attributes
     * @return array
    */

    private function only($data)
    {
        $filtered = [
            "ip_address" => $data['ip_address'],
            "label" => $data['label'],
        ];

        return $filtered;
    }
}