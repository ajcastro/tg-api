<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (is_auth()) {
        return view('home_auth');
    }

    return view('home');
});

Route::get('/login', function () {
    cache(['is_auth' => true]);

    return redirect('/');
});

Route::get('/logout', function () {
    cache(['is_auth' => false]);

    return redirect('/');
});

Route::get('/register', function () {
    return view('register');
});

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
