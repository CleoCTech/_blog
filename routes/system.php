<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\AttachmentsController as SystemAttachmentsController;
use App\Http\Controllers\System\CompanyInformationController as SystemCompanyInformationController;
use App\Http\Controllers\System\SocialMediasController as SystemSocialMediasController;
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
});
Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return redirect('/');
});
Route::get('/optimize', function() {
    Artisan::call('optimize');
    return redirect('/');
});
