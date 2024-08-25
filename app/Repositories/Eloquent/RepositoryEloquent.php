<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class RepositoryEloquent extends BaseRepository 
{
    public function withTrashed()
    {
        $this->model = $this->model->withTrashed();

        return $this;
    }
}