<?php

use App\Http\Controllers\Api\Admin\GameListController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum']], function () {
    require __DIR__.'/admin/clients.php';
    require __DIR__.'/admin/game_categories.php';
    require __DIR__.'/admin/parent_groups.php';
    require __DIR__.'/admin/websites.php';
    require __DIR__.'/admin/members.php';
    require __DIR__.'/admin/member_transactions.php';
    require __DIR__.'/admin/users.php';
    require __DIR__.'/admin/roles.php';
    require __DIR__.'/admin/permissions.php';
    require __DIR__.'/admin/company_banks.php';
    require __DIR__.'/admin/promotions.php';
    require __DIR__.'/admin/promotion_releases.php';
    require __DIR__.'/admin/bank_groups.php';
    require __DIR__.'/admin/banks.php';
    require __DIR__.'/admin/rebate_settings.php';
    require __DIR__.'/admin/rebate_logs.php';
    require __DIR__.'/admin/referral_settings.php';
    require __DIR__.'/admin/referral_logs.php';
    require __DIR__.'/admin/website_settings.php';
    require __DIR__.'/admin/page_contents.php';
    require __DIR__.'/admin/contact_settings.php';
    require __DIR__.'/admin/guide_lists.php';
    require __DIR__.'/admin/guide_contents.php';
    require __DIR__.'/admin/transfer_logs.php';
    require __DIR__.'/admin/user_logs.php';

    Route::get('game_list', GameListController::class)->name('game_list');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::get('me', [AuthController::class, 'user']); // alias of user
        Route::post('change_password', [AuthController::class, 'changePassword']);
    });
});
