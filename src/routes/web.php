<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * CLIENT
 */

// Auth::routes([
//     'register' => false,
//     'reset' => false,
// ]);

// Route::get('/', [HomeController::class, 'index'])->name('index');

/*
 * ADMIN
 */

Route::prefix('/')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::resource('/category', CategoryController::class);

        Route::post('/category/sort', [CategoryController::class, 'updateSortCategories'])->name('category.sort');

        Route::resource('/tag', TagController::class);

        Route::resource('/article', ArticleController::class);

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

        Route::post('/media', [MediaController::class, 'upload'])->name('media.upload');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
