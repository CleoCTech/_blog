<?php

use App\Http\Controllers\System\AdvertsController as SystemAdvertsController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\AttachmentsController as SystemAttachmentsController;
use App\Http\Controllers\System\CompanyInformationController as SystemCompanyInformationController;
use App\Http\Controllers\System\ProductsController as SystemProductsController;
use App\Http\Controllers\System\SocialMediasController as SystemSocialMediasController;
use App\Http\Controllers\System\UsersController;
use Illuminate\Support\Facades\Artisan;

Route::prefix('system')->group(function () {
    /***
     * Company Information
     */
    Route::get('/company-information',[SystemCompanyInformationController::class,'index'])->name('system.company');;
    Route::get('/company-information/show/{uuid}',[SystemCompanyInformationController::class,'show']);
    Route::get('/company-information/edit/{uuid}',[SystemCompanyInformationController::class,'edit']);
    Route::post('/company-information/store',[SystemCompanyInformationController::class,'store']);

    /***
     * Social Media
     */
    Route::get('/social-media',[SystemSocialMediasController::class,'index'])->name('system.social');
    Route::get('/social-media/create',[SystemSocialMediasController::class,'create']);
    Route::get('/social-media/show/{uuid}',[SystemSocialMediasController::class,'show']);
    Route::get('/social-media/edit/{uuid}',[SystemSocialMediasController::class,'edit']);
    Route::post('/social-media/store',[SystemSocialMediasController::class,'store']);
    Route::delete('/social-media/delete/{uuid}',[SystemSocialMediasController::class,'destroy']);
    Route::get('/social-media/report/{name}',[SystemSocialMediasController::class,'report']);

    /***
     * Adverts
     */
    Route::get('/advert',[SystemAdvertsController::class,'index'])->name('system.advert');
    Route::get('/advert/create',[SystemAdvertsController::class,'create']);
    Route::get('/advert/show/{uuid}',[SystemAdvertsController::class,'show']);
    Route::get('/advert/edit/{uuid}',[SystemAdvertsController::class,'edit']);
    Route::post('/advert/store',[SystemAdvertsController::class,'store']);
    Route::delete('/advert/delete/{uuid}',[SystemAdvertsController::class,'destroy']);
    Route::get('/advert/report/{name}',[SystemAdvertsController::class,'report']);

    /***
     * Products
     */
    Route::get('/product',[SystemProductsController::class,'index'])->name('system.product');
    Route::get('/product/create',[SystemProductsController::class,'create']);
    Route::get('/product/show/{uuid}',[SystemProductsController::class,'show']);
    Route::get('/product/edit/{uuid}',[SystemProductsController::class,'edit']);
    Route::post('/product/store',[SystemProductsController::class,'store']);
    Route::delete('/product/delete/{uuid}',[SystemProductsController::class,'destroy']);
    Route::get('/product/report/{name}',[SystemProductsController::class,'report']);

    /***
     * Users
     */
    Route::get('/users',[UsersController::class,'index'])->name('system.users');
    Route::get('/users/create',[UsersController::class,'create']);
    Route::get('/users/show/{uuid}',[UsersController::class,'show']);
    Route::get('/users/edit/{uuid}',[UsersController::class,'edit']);
    Route::post('/users/store',[UsersController::class,'store']);
    Route::delete('/users/delete/{uuid}',[UsersController::class,'destroy']);
    Route::get('/users/report/{name}',[UsersController::class,'report']);
});
Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return redirect('/');
});
Route::get('/optimize', function() {
    Artisan::call('optimize');
    return redirect('/');
});
