<?php

namespace App\Repositories\Eloquent;

use App\Models\IPAddress;
use App\Repositories\Contracts\IPAddressRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class IPAddressRepositoryEloquent
 * 
 * @package namespace App\Repositories\Eloquent
 */
class IPAddressRepositoryEloquent extends RepositoryEloquent implements IPAddressRepository
{
    /**
     * Specify Model Class Name
     * 
     * @return string
     */
    public function model()
    {
        return IPAddress::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}