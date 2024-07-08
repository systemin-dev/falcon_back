<?php

use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'role.admin'])->name('admin.')->prefix('/admin')->group(function () {
    // This Roles can manage with Admin & Writers with specific policies.
    Route::resource('/user', UserController::class, ['except' => ['create', 'store', 'show']]);
    Route::resource('/role', RoleController::class, ['only' => ['index']]);
    Route::resource('/setting', SettingController::class, ['only' => ['index', 'update']]);
    Route::resource('/newsletters', NewsletterController::class);
});