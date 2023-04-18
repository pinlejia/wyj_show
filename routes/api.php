<?php

use App\Modules\Controllers\Brands\BrandsController;
use App\Modules\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:api'])->group(function () {
    Route::post('auth/login', [LoginController::class, 'login'])->withoutMiddleware('auth:api');
    Route::post('auth/logout', [LoginController::class, 'logout']);
    Route::get('auth/user', [LoginController::class, 'user']);
    Route::get('auth/refresh', [LoginController::class, 'refresh']);

    Route::apiResource("brand", BrandsController::class);
});
