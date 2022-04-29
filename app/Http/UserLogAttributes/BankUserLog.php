<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class BankUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => 'View list of Banks',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "View Record",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Add Bank",
            'detail' => "{$request->code}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Update Bank",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Activate Bank",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Deactivate Bank",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }
}
