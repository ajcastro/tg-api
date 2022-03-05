<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Controllers\Traits\ResolvesModel;
use App\Http\Controllers\Traits\ResolvesRequest;
use App\Http\Controllers\Traits\ShowResource;
use App\Http\Queries\MemberTransactionQuery;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;

class MemberTransactionController extends Controller
{
    use ResolvesModel;
    use ResolvesRequest;
    use PaginateOrListResource;
    use ShowResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = MemberTransaction::class;
        });

        $this->hook(function () {
            $this->query = new MemberTransactionQuery;
        })->only(['index', 'show']);
    }

    public function approve(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->approve($request->user());
    }


    public function reject(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->reject($request->user());
    }

    public function enterRemarks(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->remarks = $request->remarks;
        $memberTransaction->save();
    }
}
