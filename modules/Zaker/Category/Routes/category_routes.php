<?php

use Illuminate\Support\Facades\Route;

//Route::group(["namespace"=>'Zaker\Category\Http\Controllers','middleware'=>['web']],function ($router){
Route::group(['middleware' => 'auth:api', 'prefix' => 'api'], function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::apiResource('categories',\Zaker\Category\Http\Controllers\CategoryController::class);

});
