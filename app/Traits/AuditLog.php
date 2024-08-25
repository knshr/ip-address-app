<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

trait AuditLog
{
    /**
     * Attribute key of transaction
     */
    protected $auditable_id;

    /**
     * Attribute type of transaction
     */
    protected $auditable_type;

    /**
     * Attribute event of transaction
     */
    protected $event;

    /**
     * Set the audit event : created, updated, deleted
     */
    public function setAuditEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Set audit key id and type attribute
     */
    public function setAuditableKeyType($id, $type)
    {
        $this->auditable_id = $id;
        $this->auditable_type = $type;

        return $this;
    }

    /**
     * Store transformed audits
     */
    private function storeAudit($transformed)
    {
        DB::table('audit_logs')->insert($transformed);

        return $this;
    }

    /**
     * Process of saving audits
     * @data - passed attributes of audits
     * @event - set as created, updated or deleted
     */
    public function toAudit($data, $event)
    {
        $this->event = $event;
        $transformed = $this->transformAudits($data);

        try {
            $this->storeAudit($transformed);

            $this->cleanAttributes();
        } catch (\Exception $e) {
            Log::error($e);
            Log::error('Unable to insert audits');
        }

        return $this;
    }

    /**
     * Reset attributes after process
     */

    protected function cleanAttributes()
    {
        $this->auditable_type = null;
        $this->auditable_id = null;
        $this->event = null;
    }

    /**
     * Transform the attributes of data
     */
    protected function transformAudits($data)
    {
        $oldValues = $this->resolveValue('old', $data);
        $newValues = $this->resolveValue('new', $data);

        return [
            'user_id'           => isset($data['user_id']) ? $data['user_id'] : $this->getAuditTraitUser(),
            'auditable_id'      => isset($data['url']) ? $data['auditable_id'] : $this->auditable_id,
            'auditable_type'    => isset($data['auditable_type']) ? $data['auditable_type'] : $this->auditable_type,
            'event'             => $this->event,
            'old_values'        => $oldValues,
            'new_values'        => $newValues,
            'url'               => isset($data['url']) ? $data['url'] : $this->getRequestUrl(),
            'ip_address'        => isset($data['ip_address']) ? $data['ip_address'] : $this->getRequestIpAddress(),
            'user_agent'        => isset($data['ip_address']) ? $data['ip_address'] : $this->getRequestUserAgent(),
            'created_at'        => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ];
    }

    /**
     * Resolve value attributes
     */

    private function resolveValue($name, $data, $isRaw = false)
    {
        if (isset($data[$name])  && !empty($data[$name])) {
            $value = $data[$name];

            $arrayValue = json_encode($value);

            if ($isRaw) {
                $arrayValue = $this->quoteValue(json_encode($value));
            }

            return is_array($value) ? $arrayValue : $value;
        }

        return $this->quoteValue(json_encode([]));
    }

    /**
     * Parse data with quotes
    */
    private function quoteValue($value)
    {
        return '\''. $value . '\'';
    }

    /**
     * Get Logged in user for audit user
     */
    protected function getAuditTraitUser()
    {
        return Auth::user()->id;
    }

    /**
     * Get request URL of transaction
     */
    protected function getRequestUrl()
    {
        return Request::fullUrl();
    }

    /**
     * Get request IP of transaction
     */
    protected function getRequestIpAddress()
    {
        return Request::ip();
    }

    /**
     * Get request user agent of transaction
     */
    protected function getRequestUserAgent()
    {
        return Request::header('User-Agent');
    }
    
}