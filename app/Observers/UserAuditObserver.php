<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class UserAuditObserver
{
    public function creating($model)
    {
        if (Auth::check()) {
            if (is_null($model->created_by)) {
                $model->created_by = Auth::user()->id;
            }

            if (is_null($model->modified_by)) {
                $model->modified_by = Auth::user()->id;
            }
        }
    }

    public function updating($model)
    {
        if (Auth::check()) {
            $model->modified_by = Auth::user()->id;
        }
    }
}