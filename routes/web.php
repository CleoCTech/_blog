<?php

use App\Http\Controllers\GeneralContoller as GuestGeneralContoller;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
/**
 * Auth User
 */
Route::get('/dashboard',[GuestGeneralContoller::class,'dashboard']);

/**
 * Guest
 */
// Route::get('/',[GuestGeneralContoller::class,'home'])->name('home');
Route::controller(GuestGeneralContoller::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/topbar-data','topBarData')->name('topBarData');
    Route::get('/footer-data','footerData')->name('footerData');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[AdminGeneralController::class,'dashboard'])->name('admin.dashboard');
});

Route::group([], __DIR__.'/system.php');