<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
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

Route::get('/category/categories-parent', [CategoryController::class, 'categoriesParent']);

Route::prefix('/article')->group(function () {
    Route::get('/articles-popular', [ArticleController::class, 'articlesPopular']);
    Route::get('/articles-new', [ArticleController::class, 'articlesNew']);
});
