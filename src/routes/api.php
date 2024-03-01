<?php

use App\Http\Controllers\Api\Article\ArticleDetailController;
use App\Http\Controllers\Api\Article\ArticlesByCategoryController;
use App\Http\Controllers\Api\Article\ArticlesNewController;
use App\Http\Controllers\Api\Category\CategoriesParentController;
use App\Http\Controllers\Api\Category\CategoriesPopularWithArticlesNewController;
use App\Http\Controllers\Api\Category\CategoryDetailController;
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

Route::prefix('/category')->group(function () {
    Route::get('/detail/{slug}', CategoryDetailController::class);
    Route::get('/categories-parent', CategoriesParentController::class);
    Route::get('/categories-popular', CategoriesPopularWithArticlesNewController::class);
});

Route::prefix('/article')->group(function () {
    Route::get('/detail/{slug}', ArticleDetailController::class);
    Route::get('/articles-new', ArticlesNewController::class);
    Route::get('/articles-by-category/{slug}', ArticlesByCategoryController::class);
});
