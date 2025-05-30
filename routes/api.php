<?php

use App\Http\Controllers\V1\AnimalColorController;
use App\Http\Controllers\V1\AnimalController;
use App\Http\Controllers\V1\AnimalObjectController;
use App\Http\Controllers\V1\AnimalOwnerController;
use App\Http\Controllers\V1\AnimalTransferController;
use App\Http\Controllers\V1\AnimalTransferStatusController;
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


    Route::prefix('v1')->group(function () {
        Route::prefix('animal')->group(function () {
            Route::apiResource('animal', AnimalController::class);
            Route::apiResource('transfer/', AnimalTransferController::class);
            Route::apiResource('transfer/transfer-status', AnimalTransferStatusController::class)->only(['index']);
        });

        Route::apiResource('object', AnimalObjectController::class);
        Route::apiResource('owner', AnimalOwnerController::class);
        Route::apiResource('color', AnimalColorController::class);

    });

