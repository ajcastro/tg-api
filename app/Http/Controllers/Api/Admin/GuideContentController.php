<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Queries\GuideListQuery;
use App\Http\Requests\Api\Admin\GuideContentRequest;
use App\Http\UserLogAttributes\GuideContentUserLog;
use App\Models\GuideContent;
use App\Models\GuideList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuideContentController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->crudUserLog = new GuideContentUserLog;
        });

        $this->hook(function ($request) {
            $this->query = $this->buildQuery($request);
        })->only(['index']);

        $this->hook(function () {
            $this->request = GuideContentRequest::class;
        })->only(['update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord(
            $request->route('guide_list') ?? $request->route('guide_content')
        );
    }

    private function requireSelectedWebsiteId(Request $request)
    {
        $request->validate(['website_selector_website_id' => ['required']]);
    }


    private function buildQuery($request)
    {
        $this->requireSelectedWebsiteId($request);
        $query = GuideList::where('is_active', 1)
            ->with(['guideContent' => function ($query) use ($request) {
                $query->where('guide_contents.website_id', $request->website_selector_website_id);
            }]);

        return new GuideListQuery($query);
    }

    public function getGuideList($id): GuideList
    {
        return $this->buildQuery(request())->findOrFail($id);
    }

    public function getRecord($id)
    {
        return $this->getGuideList($id);
    }

    public function setActiveStatus($id, Request $request)
    {
        $guideList = $this->getGuideList($id);

        $instance = $guideList->guideContent;
        $instance->website_id = $instance->website_id ?? $request->website_selector_website_id;
        $instance->setActive($request->boolean('is_active', true))->save();

        return $instance;
    }

    public function show($id)
    {
        $guideList = $this->getGuideList($id);
        return JsonResource::make($guideList);
    }

    public function update($id)
    {
        $request = $this->request();
        $guideList = $this->getGuideList($id);
        $guideContent = $guideList->guideContent;

        $guideContent->fill([
            'website_id' => $request->website_selector_website_id,
            'content' => $request->content,
        ]);

        $guideContent->save();

        return new JsonResource($guideList);
    }
}
