<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class GuideContentUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => 'View list of Guide Contents',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "View Guide Content ",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Add Guide Content",
            'detail' => "{$request->title}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Update Guide Content",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Activate Guide Content",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Deactivate Guide Content",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }
}
