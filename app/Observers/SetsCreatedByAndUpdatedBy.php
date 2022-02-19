<?php

namespace App\Observers;

class SetsCreatedByAndUpdatedBy
{
    public function creating($model)
    {
        $model->created_by_id = auth()->user()->id ?? 0;
        $model->updated_by_id = auth()->user()->id ?? 0;
    }

    public function updating($model)
    {
        $model->updated_by_id = auth()->user()->id ?? 1;
    }
}
