<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Zaker\User\Http\Controllers\Auth\AuthController;
use Zaker\User\Http\Controllers\Auth\PasswordResetController;

Route::namespace('Laravel\Passport\Http\Controllers')->group(function () {
    Route::post('login', [AccessTokenController::class, 'issueToken']);
});
Route::post('api/register',[AuthController::class,'register']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'api'], function () {
    Route::post('verify_code', [AuthController::class, 'registerVerify']);
    Route::post('password_reset_code', [PasswordResetController::class, 'passwordResetCode']);//بازیابی رمز عیور
    Route::post('check_verification_code', [PasswordResetController::class, 'checkVerifyCode']);
    Route::post('new_password', [PasswordResetController::class, 'NewPassword']);
});
;
