<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetAPIKairaController;

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

Route::middleware(['custom.bearer'])->group(function () {
    Route::group(['prefix' => '/v1'], function() {
        Route::get('short-urls/{url?}', GetAPIKairaController::class)->name('api.short-urls');
    });
});


