<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WebpagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [WebpagesController::class, 'home'])->name('home');

Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('empleados')->group(function () {
        Route::get('pizarra', [UserController::class, 'index'])->name('pizarraEmpleados');
        Route::post('json', [UserController::class, 'getDataJson']);
    });
});
