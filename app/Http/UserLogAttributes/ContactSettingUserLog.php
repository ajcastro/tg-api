<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class ContactSettingUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => 'View list of Contact Settings',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "View Contact Setting ",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Add Contact Setting",
            'detail' => "{$request->title}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Update Contact Setting",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Activate Contact Setting",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'CMS',
            'activity' => "Deactivate Contact Setting",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }
}
