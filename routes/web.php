<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact')->withoutMiddleware(['auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware(['auth']);
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about'])->name('about')->withoutMiddleware(['auth']);
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services')->withoutMiddleware(['auth']);
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/', [App\Http\Controllers\UserDashboardController::class, 'index']);

    //Update profile
    Route::get('profile/{id}', [App\Http\Controllers\UserController::class, 'editProfile']);
    Route::put('profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile']);

    //REPORT CRIME ROUTES
    Route::get('crimes', [App\Http\Controllers\CrimeController::class, 'index']);
    Route::get('add-crime', [App\Http\Controllers\CrimeController::class, 'create']);
    Route::post('add-crime', [App\Http\Controllers\CrimeController::class, 'store']);
    Route::get('edit-crime/{id}', [App\Http\Controllers\CrimeController::class, 'edit']);
    Route::put('edit-crime/{id}', [App\Http\Controllers\CrimeController::class, 'update']);
    Route::get('delete-crime/{id}', [App\Http\Controllers\CrimeController::class, 'destroy']);
    Route::get('crime_status/{id}', [App\Http\Controllers\CrimeController::class, 'edit']);

    Route::post('/sms', [App\Http\Controllers\SendSmsController::class, 'send']);

});

//Anonymous crime reporting
Route::get('report-crime', [App\Http\Controllers\CrimeController::class, 'reportCrime']);
Route::post('report-crime', [App\Http\Controllers\CrimeController::class, 'saveCrime']);

Route::prefix('admin')->middleware(['auth', 'IsAdmin', 'verified'])->group(function(){
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

    //REPORT CRIME ROUTES
    Route::get('crimes-export', [App\Http\Controllers\Admin\DashboardController::class, 'exportCrimes']);
    Route::get('unassigned_crimes-export', [App\Http\Controllers\Admin\DashboardController::class, 'exportUnassignedCrimes']);
    Route::get('crimes_under_investigation-export', [App\Http\Controllers\Admin\DashboardController::class, 'exportcrimes_under_investigation']);
    Route::get('crimes', [App\Http\Controllers\Admin\DashboardController::class, 'reportedCrimes']);
    Route::get('add-crime', [App\Http\Controllers\Admin\DashboardController::class, 'create']);
    Route::post('add-crime', [App\Http\Controllers\Admin\DashboardController::class, 'store']);
    Route::get('edit-crime/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'edit']);
    Route::get('view-crime/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'viewCrime']);
    Route::put('edit-crime/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'update']);
    Route::get('delete-crime/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'destroy']);
    Route::get('crime_status/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'edit']);
    Route::get('crime-assigment/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'crimeAssign']);
    Route::put('crime-assigment/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'crimeAssigment']);
    Route::get('unassigned_crimes', [App\Http\Controllers\Admin\DashboardController::class, 'unassigned_crimes']);
    Route::get('crimes_under_investigation', [App\Http\Controllers\Admin\DashboardController::class, 'crimes_under_investigation']);
    Route::get('add-evidence/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'crimeEvidence']);
    Route::put('add-evidence/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'crimeAddEvidence']);
    Route::get('crime-close/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'crimeClose']);
    Route::put('crime-close/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'closeCrime']);

    //INVESTIGATING OFFICERS
    Route::get('investigating_officers', [App\Http\Controllers\InvestigatingOfficerController::class, 'index']);
    Route::get('add-investigating_officer', [App\Http\Controllers\InvestigatingOfficerController::class, 'create']);
    Route::post('add-investigating_officer', [App\Http\Controllers\InvestigatingOfficerController::class, 'store']);
    Route::get('edit-investigating_officer/{id}', [App\Http\Controllers\InvestigatingOfficerController::class, 'edit']);
    Route::put('edit-investigating_officer/{id}', [App\Http\Controllers\InvestigatingOfficerController::class, 'update']);
    Route::get('delete-investigating_officer/{id}', [App\Http\Controllers\InvestigatingOfficerController::class, 'destroy']);

    //REPORTS
    Route::get('reported_cases', [App\Http\Controllers\Admin\DashboardController::class, 'reported_cases']);
    Route::get('reporters', [App\Http\Controllers\Admin\DashboardController::class, 'reporters']);
    Route::get('officers', [App\Http\Controllers\Admin\DashboardController::class, 'officers']);
});
