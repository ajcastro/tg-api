<?php

namespace App\Http\Controllers\Traits;

use App\Http\UserLogAttributes\Contracts\CrudUserLogContract;
use App\Models\UserLog;
use Exception;
use Illuminate\Http\Request;

trait CrudUserLog
{
    protected CrudUserLogContract $crudUserLog;

    protected function setUpCrudUserLog()
    {
        $this->hook(function (Request $request) {
            $this->makeUserLog($request, $this->crudUserLog->index($request))->save();
        })->only(['index']);

        $this->hook(function (Request $request) {
            $this->makeUserLog($request, $this->crudUserLog->show($request, $this->resolveRecord($request)))->save();
        })->only(['show']);

        $this->hook(function (Request $request) {
            $this->makeUserLog($request, $this->crudUserLog->store($request))->save();
        })->only(['store']);

        $this->hook(function (Request $request) {
            $this->makeUserLog($request, $this->crudUserLog->update($request, $this->resolveRecord($request)))->save();
        })->only(['update']);

        $this->hook(function (Request $request) {
            if ($request->boolean('is_active')) {
                $this->makeUserLog($request, $this->crudUserLog->activate($request, $this->resolveRecord($request)))->save();
            } else {
                $this->makeUserLog($request, $this->crudUserLog->deactivate($request, $this->resolveRecord($request)))->save();
            }
        })->only(['setActiveStatus']);
    }

    protected function resolveRecord(Request $request)
    {
        throw new Exception('Missing method resolveRecord() in '.get_class($this));
    }

    protected function makeUserLog(Request $request, array $userLogAttributes): UserLog
    {
        return UserLog::make($userLogAttributes + [
            'website_id' => $this->resolveWebsiteIdForUserLog($request),
            'user_id' => $request->user()->id,
            'date' => now(),
            'user_ip' => $request->ip(),
            'user_info' => agent_user_info(),
            'member_id' => $this->resolveMemberIdForUserLog($request),
        ]);
    }

    protected function resolveWebsiteIdForUserLog(Request $request)
    {
        return $request->input('website_selector_website_id');
    }

    protected function resolveMemberIdForUserLog(Request $request)
    {
        return $request->input('member_id');
    }
}
