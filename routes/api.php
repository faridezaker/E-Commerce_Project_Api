<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AdminPanel\Auth\AuthController;
use App\Http\Controllers\AdminPanel\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])->name('passport.token');
//Route::namespace('Laravel\Passport\Http\Controllers')->group(function () {
//    Route::post('login', [AccessTokenController::class, 'issueToken']);
//});

Route::namespace('Laravel\Passport\Http\Controllers')->group(function () {
    Route::post('login', [AccessTokenController::class, 'issueToken']);
});
Route::post('register',[AuthController::class,'register']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'api'], function () {
    Route::post('verify_code', [AuthController::class, 'registerVerify']);
    Route::post('password_reset_code', [PasswordResetController::class, 'passwordResetCode']);//بازیابی رمز عیور
    Route::post('check_verification_code', [PasswordResetController::class, 'checkVerifyCode']);
    Route::post('new_password', [PasswordResetController::class, 'NewPassword']);
});

//Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('categories',\App\Http\Controllers\AdminPanel\CategoryController::class);
Route::apiResource('roles',\App\Http\Controllers\AdminPanel\RolePermissionController::class);
//});
