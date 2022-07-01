<?php

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserPageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('photo', PhotoController::class)->only('index');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('photo', PhotoController::class)->except('index');
    Route::get('user/{id}', [UserPageController::class, 'index'])->name('user_page');
});