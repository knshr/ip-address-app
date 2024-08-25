<?php

namespace App\Traits;

use App\Observers\UserAuditObserver;
use Illuminate\Support\Facades\Auth;

trait UserAudit
{
    public static function bootUserAudit()
    {
        static::observe(new UserAuditObserver());
    }

    /**
     * Override soft delete if ever the model has the Soft Delete trait to update the modified_by
     * column
     *
     * @return void
     */
    protected function runSoftDelete()
    {
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());

        $time = $this->freshTimestamp();

        $columns = [
            $this->getDeletedAtColumn() => $this->fromDateTime($time),
            $this->getModifiedByColumn() => Auth::user()->id
        ];

        $this->{$this->getDeletedAtColumn()} = $time;
        $this->{$this->getModifiedByColumn()} = Auth::user()->id;

        if ($this->timestamps && ! is_null($this->getUpdatedAtColumn())) {
            $this->{$this->getUpdatedAtColumn()} = $time;

            $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
        }

        $query->update($columns);
    }

    protected function getModifiedByColumn()
    {
        return 'modified_by';
    }
}