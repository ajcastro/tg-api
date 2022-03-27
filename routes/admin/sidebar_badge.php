<?php

use Illuminate\Support\Facades\Route;

Route::get('sidebar_badge', [App\Http\Controllers\Api\Admin\SidebarBadgeController::class, 'list'])->name('sidebar_badge.index');
