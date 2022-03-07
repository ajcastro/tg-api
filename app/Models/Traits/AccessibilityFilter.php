<?php

namespace App\Models\Traits;

use App\Models\Contracts\AccessibleByUser;
use App\Models\Contracts\RelatesToWebsite;
use App\Models\Website;

/**
 * @method static void applyAccessibilityFilter($request = null)
 */
trait AccessibilityFilter
{
    public function scopeApplyAccessibilityFilter($query, $request = null)
    {
        $request = $request ?? request();

        logger('start jere');

        if ($this->shouldQueryByWebsiteRelation($query, $request)) {
            $query->ofWebsite(id_to_model(Website::class, $request->input('website_selector_website_id')));
            logger('relates to website filter');
        }

        if ($this->implementsAccessibleBy($query)) {
            $query->accessibleBy($request->user());
            logger('accessible by user filter');
        }
    }

    protected function shouldQueryByWebsiteRelation($query, $request)
    {
        $model = $query->getModel();
        return $model instanceof RelatesToWebsite && filled($request->input('website_selector_website_id'));
    }

    protected function implementsAccessibleBy($query)
    {
        $model = $query->getModel();
        return $model instanceof AccessibleByUser;
    }
}
