<?php

use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\CategoryController;
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
    return view('welcome');
});

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Blog manager routes
    Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
        Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{id}/force_delete', [CategoryController::class, 'forceDelete'])->name('categories.force_delete');
        Route::get('categories/archives', [ArchiveController::class, 'category'])->name('categories.archive');
        Route::resource('categories', CategoryController::class);
    });
});
