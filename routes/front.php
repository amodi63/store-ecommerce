<?php

use App\Http\Controllers\Frontend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Frontend\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Frontend\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Frontend\Auth\NewPasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordResetLinkController;
use App\Http\Controllers\Frontend\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/',function(){
    return view('front.index');
})->name('home');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        Route::group(['middleware' => ['auth:web', 'verified'], 'as' => 'user.'], function () {
            Route::get('profile', function() {
                return 'Profile Page';
                
            });
        });
    });