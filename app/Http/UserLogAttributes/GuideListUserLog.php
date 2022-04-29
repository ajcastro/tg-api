<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class GuideListUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => 'View list of Guides',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "View Guide ",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Add Guide",
            'detail' => "{$request->title}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Update Guide",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Activate Guide",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Deactivate Guide",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }
}
