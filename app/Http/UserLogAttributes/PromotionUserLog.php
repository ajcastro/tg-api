<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class PromotionUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'PROMO',
            'activity' => 'View list of Promotions',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "View Record #{$record->id}, {$record->title}",
            'detail' => '',
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Add Promo {$request->title}",
            'detail' => '',
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Update Promo #{$record->id}, {$record->title}",
            'detail' => '',
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Activate Promo #{$record->id}, {$record->title}",
            'detail' => '',
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Deactivate Promo #{$record->id}, {$record->title}",
            'detail' => '',
        ];
    }
}
