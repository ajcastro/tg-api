<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Schema;

trait ReturnsTableColumns
{
    public static function tableColumns()
    {
        return remember([__CLASS__, __METHOD__], now()->addMinute(15), function () {
            return Schema::getColumnListing((new static)->getTable());
        });
    }
}
