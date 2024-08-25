<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface Repository
 * @package namespace App\Repositories\Contracts;
 */
interface Repository extends RepositoryInterface
{
    public function withTrashed();
}