<?php

namespace App\Http\UserLogAttributes\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface CrudUserLogContract
{
    public function index(Request $request): array;

    public function show(Request $request, Model $record): array;

    public function store(Request $request): array;

    public function update(Request $request, Model $record): array;

    public function activate(Request $request, Model $record): array;

    public function deactivate(Request $request, Model $record): array;
}
