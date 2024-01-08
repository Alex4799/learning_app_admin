<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('user/login',[UserController::class,'login_user']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('course',[CourseController::class,'getCourse_user']);
    });

});


