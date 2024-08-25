<?php

namespace App\Repositories\Eloquent;

use App\Models\AuditLog;
use App\Repositories\Contracts\AuditLogRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AuditLogRepositoryEloquent
 * 
 * @package namespace App\Repositories\Eloquent
 */
class AuditLogRepositoryEloquent extends RepositoryEloquent implements AuditLogRepository
{
    /**
     * Specify Model Class Name
     * 
     * @return string
     */
    public function model()
    {
        return AuditLog::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findManyIpAddress($id)
    {
        return $this->model->where('auditable_type', 'ip_addresses')->where('auditable_id', $id)->orderBy('created_at','desc')->get();
    }
}