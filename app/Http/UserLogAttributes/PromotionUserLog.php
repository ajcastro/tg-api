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
            'activity' => "View Promo ",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Add Promo",
            'detail' => "{$request->title}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Update Promo",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Activate Promo",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'PROMO',
            'activity' => "Deactivate Promo",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }
}
