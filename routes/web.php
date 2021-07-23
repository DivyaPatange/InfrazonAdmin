<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ModelController;

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

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'DONE'; //Return anything
});

Route::get('/routeList', function () {
    $exitCode = Artisan::call('route:list');
    return Artisan::output(); //Return anything
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return 'DONE'; //Return anything
});

//create symbolic link for storage
Route::get('/symlink', function () {
    return view('symlink');
});

Route::get('/', function () {
    return view('admin.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Category Route
    Route::resource('/categories', CategoryController::class);
    Route::post('/get-category', [CategoryController::class, 'getCategory'])->name('get.category');
    Route::post('/category/update', [CategoryController::class, 'updateCategory']);

    // Company Route
    Route::resource('/companies', CompanyController::class);
    Route::post('/get-company', [CompanyController::class, 'getCompany'])->name('get.company');
    Route::post('/company/update', [CompanyController::class, 'updateCompany']);

    // Model Route
    Route::resource('/models', ModelController::class);
    Route::post('/get-model', [ModelController::class, 'getModel'])->name('get.model');
    Route::post('/model/update', [ModelController::class, 'updateModel']);
});