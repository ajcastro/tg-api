<?php

namespace App\Models\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

trait HasAllowableFields
{
    public static function tableColumns()
    {
        return remember([__CLASS__, __METHOD__], now()->addMinute(15), function () {
            return Schema::getColumnListing((new static)->getTable());
        });
    }

    public static function allowableFields()
    {
        return collect(static::tableColumns())->diff((new static)->getHidden())->values()->all();
    }
}
