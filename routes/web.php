<?php

use App\Http\Controllers\GeneralContoller as GuestGeneralContoller;
use App\Http\Controllers\Admin\GeneralController as AdminGeneralController;
use App\Http\Controllers\Admin\QoutesController;
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
Route::get('/dashboard',[GuestGeneralContoller::class,'dashboard'])->name('guest-dashboard');

/**
 * Guest
 */
// Route::get('/',[GuestGeneralContoller::class,'home'])->name('home');
Route::controller(GuestGeneralContoller::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'aboutUs')->name('about-us');
    Route::get('/contact-us', 'contact')->name('contact-us');
    Route::get('/topbar-data','topBarData')->name('topBarData');
    Route::get('/footer-data','footerData')->name('footerData');
    Route::get('/post-categories','categories')->name('post-categories');
    Route::post('/customer-inquiry','sendMessage')->name('inquiry');
    Route::post('/subscribe','subscribe')->name('subscribe');
    
    Route::get('/browse/{title}', 'browse')->name('browse');
    Route::get('/browse/{title}/{sub_title}', 'browseSubcategory')->name('browse-sub-category');
    Route::get('/post/{title}', 'post')->name('show-post');
    Route::post('/post/like', 'like')->name('like-post');
    Route::post('/post/dislike', 'dislike')->name('dislike-post');
    Route::post('/post/comment', 'comment')->name('post-comment');
    Route::get('/post/comments/{uuid}', 'comments')->name('get-comments');
    Route::post('/post/comments/reply', 'reply')->name('post-reply');
});
Route::prefix('guest')->group(function () {
    /***
     * Posts 
     */
    Route::get('/post',[PostController::class,'index'])->name('guest-post');
    Route::get('/post/create',[PostController::class,'create']);
    Route::get('/post/show/{uuid}',[PostController::class,'show']);
    Route::get('/post/edit/{uuid}',[PostController::class,'edit']);
    Route::post('/post/store',[PostController::class,'store']);
    Route::delete('/post/delete/{uuid}',[PostController::class,'destroy']);
    Route::get('/post/report/{name}',[PostController::class,'report']);
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[AdminGeneralController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/statistics',[AdminGeneralController::class,'statistics'])->name('admin.statistics');
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
    /***
     * Qoutes 
     */
    Route::get('/qoute',[QoutesController::class,'index'])->name('admin.qoute');
    Route::get('/qoute/create',[QoutesController::class,'create']);
    Route::get('/qoute/show/{uuid}',[QoutesController::class,'show']);
    Route::get('/qoute/edit/{uuid}',[QoutesController::class,'edit']);
    Route::post('/qoute/store',[QoutesController::class,'store']);
    Route::delete('/qoute/delete/{uuid}',[QoutesController::class,'destroy']);
    Route::get('/qoute/report/{name}',[QoutesController::class,'report']);
});

Route::group([], __DIR__.'/system.php');