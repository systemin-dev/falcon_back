<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Boat\BoatController;
use App\Http\Controllers\Boat\DimensionController;
use App\Http\Controllers\Boat\BoatRangeController;

Route::middleware(['auth', 'role.editor'])->prefix('editor')->group(function () {
    Route::resource('boats', BoatController::class);
    Route::resource('boats.dimensions', DimensionController::class)->except(['show']);
    Route::resource('boats.ranges', BoatRangeController::class)->except(['show']);
});
