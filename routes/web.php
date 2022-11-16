<?php

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

Auth::routes();
Route::middleware(['auth'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\UserDashboardController::class, 'index']);
});

Route::prefix('admin')->middleware(['auth', 'IsAdmin'])->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //USER LIST
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::put('edit-user/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('delete-user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
    
    //ROLES
    Route::get('roles', [App\Http\Controllers\RoleController::class, 'index']);

    //CRIME CATEGORIES ROUTES
    Route::get('crime_categories', [App\Http\Controllers\CrimeCategoryController::class, 'index']);
    Route::get('add-crime_category', [App\Http\Controllers\CrimeCategoryController::class, 'create']);
    Route::post('add-crime_category', [App\Http\Controllers\CrimeCategoryController::class, 'store']);
    Route::get('edit-crime_category/{id}', [App\Http\Controllers\CrimeCategoryController::class, 'edit']);
    Route::put('edit-crime_category/{id}', [App\Http\Controllers\CrimeCategoryController::class, 'update']);
    Route::get('delete-crime_category/{id}', [App\Http\Controllers\CrimeCategoryController::class, 'destroy']);
});
