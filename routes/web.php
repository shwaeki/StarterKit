<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('home');
});

Auth::routes(['false' => true,'register' => false]);


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('components', [HomeController::class, 'components'])->name('components');
    Route::get('media', [HomeController::class, 'media'])->name('media.index');


    Route::resource('users', UserController::class);
    Route::get('profile/{user}', [UserController::class, 'profile'])->name('profile.edit');
    Route::post('profile/{user}', [UserController::class, 'profileUpdate'])->name('profile.update');

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('permissions', PermissionController::class)->except(['show', 'destroy', 'update']);

    Route::resource('category', CategoryController::class)->except('show');

    Route::resource('post', PostController::class);

    Route::resource('product', ProductController::class);

    Route::get('/activity-log', [SettingController::class, 'activity'])->name('activity-log.index');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');


});
