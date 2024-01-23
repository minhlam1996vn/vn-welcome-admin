<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
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
 * Client
 */

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/', [HomeController::class, 'index'])->name('index');

/*
 * ADMIN
 */

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
