<?php

namespace App\Http\UserLogAttributes;

use Illuminate\Http\Request;

class CompanyBankUserLog implements Contracts\CrudUserLogContract
{
    public function index(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => 'View list of Bank Accounts',
            'detail' => '',
        ];
    }

    public function show(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "View Record",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function store(Request $request): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Add Bank Account ",
            'detail' => "{$request->title}",
        ];
    }

    public function update(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Update Bank Account",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function activate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Activate Bank Account",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }

    public function deactivate(Request $request, $record): array
    {
        return [
            'category' => 'BANK',
            'activity' => "Deactivate Bank Account",
            'detail' => "#{$record->id}, {$record->title}",
        ];
    }
}
