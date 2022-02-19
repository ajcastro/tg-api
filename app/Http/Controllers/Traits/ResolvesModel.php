<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Database\Eloquent\Model;

trait ResolvesModel
{
    protected $model;

    protected function model(): Model
    {
        if (is_string($this->model)) {
            return $this->model::make();
        }

        if ($this->model instanceof Model) {
            return $this->model;
        }

        return $this->query->getModel();
    }
}
