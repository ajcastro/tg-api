<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class BankGroupUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => 'View List of Bank Groups',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "View Bank Group",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Add Bank Group",
            'detail' => "{$request->code}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Update Bank Group",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Activate Bank Group",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Deactivate Bank Group",
            'detail' => "#{$record->id}, {$record->code}",
        ];
    }
}
