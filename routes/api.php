<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/test', function () {
//     // dd(12312);
//     return view('welcome');
// });

Route::prefix('public')->group(function () {

    Route::post('/login', 'App\Http\Controllers\AuthenController@login')->name('login');

    // Route::get('/info', 'App\Http\Controllers\Api\AuthenController@info')->name('login')->middleware('detectUser');
});

Route::prefix('')->group(function () {

    Route::post('/learn-php', 'App\Http\Controllers\AuthenController@login')->name('test');

    // Route::get('/info', 'App\Http\Controllers\Api\AuthenController@info')->name('login')->middleware('detectUser');
});

Route::middleware(['detectAgent'])->group(function () {
    Route::get('/test', function () {
        // dd(12312);
        return view('welcome');
    });
    Route::prefix('agency')->group(function () {
        Route::get('/info', 'App\Http\Controllers\AgencyController@info')->name('agency.info');
    });
});
