<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('market_websites', App\Http\Controllers\Api\Admin\MarketWebsiteController::class)->except(['store', 'destroy']);
