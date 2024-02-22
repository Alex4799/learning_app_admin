<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CourseCategoryController;

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
Route::post('user/register',[UserController::class,'register_user']);
Route::get('user/interface',[UserInterfaceController::class,'getUserInterface_user']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('data',[UserController::class,'getUserData']);
        Route::post('update',[UserController::class,'updateUser']);
        Route::get('delete/profile',[UserController::class,'deleteProfile']);
        Route::post('delete/account',[UserController::class,'deleteAccount']);

        Route::post('change/password',[UserController::class,'changePassword']);


        Route::prefix('home')->group(function () {
            Route::get('course',[CourseController::class,'getHomeCourse_user']);
            Route::get('blog',[LessonController::class,'getHomeBlog_user']);
            Route::get('member',[UserController::class,'getMember']);
        });

        Route::prefix('blog')->group(function () {
            Route::get('get',[LessonController::class,'getBlog_user']);
            Route::get('detail/{id}',[LessonController::class,'getBlogDetail_user']);
        });

        Route::prefix('course')->group(function () {
            Route::get('get',[CourseController::class,'getCourse_user']);
            Route::get('detail/{id}',[CourseController::class,'getCourseDetail_user']);
            Route::get('get/{id}',[CourseController::class,'getUserCourse_user']);


            Route::get('category/get/{id}',[CourseCategoryController::class,'getCourseCategory_user']);
            Route::get('category/view/{id}',[CourseCategoryController::class,'viewCourseCategory_user']);
        });

        Route::prefix('lesson')->group(function () {
            Route::get('view/{id}',[LessonController::class,'viewLesson_user']);
            Route::get('done/{id}',[LessonController::class,'doneLesson_user']);
        });

        Route::prefix('course_detail')->group(function () {
            Route::get('get',[CourseDetailController::class,'getCourseDetail_user']);
            Route::get('check/{id}',[CourseDetailController::class,'checkCourse_user']);
            Route::post('enroll',[CourseDetailController::class,'enroll_user']);
        });

        Route::prefix('comment')->group(function () {
            Route::get('get/{id}',[CommentController::class,'getComment_user'])->name('user#getComment');
            Route::post('send',[CommentController::class,'sendComment_user']);
            Route::get('delete/{id}/{lesson_id}',[CommentController::class,'delete_user']);
        });

        Route::prefix('message')->group(function () {
            Route::post('send',[MessageController::class,'sendMessage_user']);
            Route::get('check',[MessageController::class,'checkMessage_user']);
            Route::get('get',[MessageController::class,'getMessage_user']);
            Route::get('view/{id}',[MessageController::class,'viewMessage_user']);
        });



    });

});



