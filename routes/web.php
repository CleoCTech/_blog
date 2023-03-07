<?php

use App\Http\Controllers\GeneralContoller as GuestGeneralContoller;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use App\Http\Controllers\Post\CategoryController as PostCategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\SubCategoryController;
use App\Http\Controllers\Post\TagController;
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

    /***
     * Category Posts
     */
    Route::get('/category-post',[PostCategoryController::class,'index'])->name('category.post');
    Route::get('/category-post/create',[PostCategoryController::class,'create']);
    Route::get('/category-post/show/{uuid}',[PostCategoryController::class,'show']);
    Route::get('/category-post/edit/{uuid}',[PostCategoryController::class,'edit']);
    Route::post('/category-post/store',[PostCategoryController::class,'store']);
    Route::delete('/category-post/delete/{uuid}',[PostCategoryController::class,'destroy']);
    Route::get('/category-post/report/{name}',[PostCategoryController::class,'report']);
    /***
     * Category SubCategories
     */
    Route::get('/category-post-sub-categories',[SubCategoryController::class,'index'])->name('category.subcategory');
    Route::get('/category-post-sub-categories/create',[SubCategoryController::class,'create']);
    Route::get('/category-post-sub-categories/show/{uuid}',[SubCategoryController::class,'show']);
    Route::get('/category-post-sub-categories/edit/{uuid}',[SubCategoryController::class,'edit']);
    Route::post('/category-post-sub-categories/store',[SubCategoryController::class,'store']);
    Route::delete('/category-post-sub-categories/delete/{uuid}',[SubCategoryController::class,'destroy']);
    Route::get('/category-post-sub-categories/report/{name}',[SubCategoryController::class,'report']);

    /***
     * Tags 
     */
    Route::get('/tag-post',[TagController::class,'index'])->name('tag.post');
    Route::get('/tag-post/create',[TagController::class,'create']);
    Route::get('/tag-post/show/{uuid}',[TagController::class,'show']);
    Route::get('/tag-post/edit/{uuid}',[TagController::class,'edit']);
    Route::post('/tag-post/store',[TagController::class,'store']);
    Route::delete('/tag-post/delete/{uuid}',[TagController::class,'destroy']);
    Route::get('/tag-post/report/{name}',[TagController::class,'report']);
    /***
     * Tags 
     */
    Route::get('/post',[PostController::class,'index'])->name('post');
    Route::get('/post/create',[PostController::class,'create']);
    Route::get('/post/show/{uuid}',[PostController::class,'show']);
    Route::get('/post/edit/{uuid}',[PostController::class,'edit']);
    Route::post('/post/store',[PostController::class,'store']);
    Route::delete('/post/delete/{uuid}',[PostController::class,'destroy']);
    Route::get('/post/report/{name}',[PostController::class,'report']);
});

Route::group([], __DIR__.'/system.php');