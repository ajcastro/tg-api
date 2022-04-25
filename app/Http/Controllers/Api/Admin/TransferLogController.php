<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\TransferLogQuery;
use App\Models\TransferLog;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferLogController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new TransferLogQuery;
        })->only(['index']);
    }

    public function show(TransferLog $transferLog)
    {
        $transferLog->load([
            'member',
        ]);

        return JsonResource::make($transferLog);
    }
}
