<?php

use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\CategoryTranslationController;
use App\Http\Controllers\Post\PageController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostTranslationController;
use App\Http\Controllers\Post\TagController;
use App\Http\Controllers\Post\TagTranslationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role.editor'])->prefix('/editor')->group(function () {
    // Routes pour les posts
    Route::resource('post', PostController::class)->except(['show']);
    Route::name('post.')->group( function (){
        Route::resource('/page', PageController::class);
        Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
        Route::get('/post/slug-get', [PostController::class, 'getSlug'])->name('post.getslug');
    
        // Routes pour les catégories
        Route::get('/category/slug-get', [CategoryController::class, 'getSlug'])->name('category.getslug');
        Route::resource('category', CategoryController::class);
    
        // Routes pour les tags
        Route::resource('tag', TagController::class);
    }); 

});
