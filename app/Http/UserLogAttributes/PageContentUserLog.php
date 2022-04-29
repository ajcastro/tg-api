<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class PageContentUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => 'View list of Page Contents',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "View Page Content ",
            'detail' => "#{$record->id}, {$record->short_description}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Add Page Content",
            'detail' => "{$request->short_description}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Update Page Content",
            'detail' => "#{$record->id}, {$record->short_description}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Activate Page Content",
            'detail' => "#{$record->id}, {$record->short_description}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Deactivate Page Content",
            'detail' => "#{$record->id}, {$record->short_description}",
        ];
    }
}
