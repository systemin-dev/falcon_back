<?php

use App\Http\Controllers\Api\ApiBoatController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiNewsletterController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\CommandController;
use Illuminate\Support\Facades\Route;




// Public Api Routes
Route::prefix('{locale?}')->group(function () {

    Route::apiResource('/posts', ApiPostController::class, ['only' => ['index', 'show']]);
    Route::get('/posts/slug/{slug}', [ApiPostController::class, 'showBySlug'])->name('posts.showBySlug');
    Route::get('/posts/findSlug/{slug}', [ApiPostController::class, 'changeLocaleSlug'])->name('posts.changeLocaleSlug');
    Route::apiResource('/categories', ApiCategoryController::class, ['only' => ['index', 'show']]);

    Route::apiResource('/boats', ApiBoatController::class, ['only' => ['index', 'show']]);
    Route::prefix('boats')->group(function () {
        Route::get('/range/{range}', [ApiBoatController::class, 'getRangeBoats']);
        Route::get('/type/{type}', [ApiBoatController::class, 'getTypeBoats']);
        Route::get('/used', [ApiBoatController::class, 'getUsedBoats']);
    });

});

Route::get('run-command', [CommandController::class, 'runCommand'])->middleware('DebugModeOnly');
Route::apiResource('/newsletters', ApiNewsletterController::class, ['only' => ['store']]);



