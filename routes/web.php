<?php

use App\Models\CourseCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\CourseCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[AuthController::class,'loginPage']);
Route::get('/loginPage',[AuthController::class,'loginPage'])->name('loginPage');
Route::get('/registerPage',[AuthController::class,'registerPage'])->name('registerPage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('authorization',[AuthController::class,'authorization'])->name('authorization');
    Route::get('change/passwordPage',[AuthController::class,'changePasswordPage'])->name('changePasswordPage');


    Route::prefix('admin')->group(function () {

        Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
        Route::get('admin/view/{id}',[AdminController::class,'adminView'])->name('admin#view');

        Route::get('dashboardPage',[AdminController::class,'dashboardPage'])->name('admin#dashboardPage');
        Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');
        Route::get('edit/profile',[AdminController::class,'editProfile'])->name('admin#editProfile');
        Route::post('update/profile',[AdminController::class,'updateProfile'])->name('admin#updateProfile');
        Route::get('delete/profile/photo',[AdminController::class,'deleteProfilePhoto'])->name('admin#deleteProfilePhoto');

        Route::prefix('course')->group(function () {
            Route::get('list',[CourseController::class,'list_admin'])->name('admin#courseList');
            Route::get('addPage',[CourseController::class,'addPage_admin'])->name('admin#addCoursePage');
            Route::post('add',[CourseController::class,'add_admin'])->name('admin#addCourse');
            Route::get('view/{id}',[CourseController::class,'view_admin'])->name('admin#viewCourse');
            Route::get('edit/{id}',[CourseController::class,'edit_admin'])->name('admin#editCourse');
            Route::post('update',[CourseController::class,'update_admin'])->name('admin#updateCourse');
            Route::get('delete/{id}',[CourseController::class,'delete_admin'])->name('admin#deleteCourse');


            Route::get('category/list/{id}',[CourseCategoryController::class,'courseCategoryList_admin'])->name('admin#courseCategoryList');
            Route::get('category/addPage/{course_id}',[CourseCategoryController::class,'addCourseCategoryPage_admin'])->name('admin#addCourseCategoryPage');
            Route::post('category/add',[CourseCategoryController::class,'addCourseCategory_admin'])->name('admin#addCourseCategory');
            Route::get('category/view/{id}',[CourseCategoryController::class,'viewCourseCategory_admin'])->name('admin#viewCourseCategory');
            Route::get('category/edit/{id}',[CourseCategoryController::class,'editCourseCategory_admin'])->name('admin#editCourseCategory');
            Route::post('category/update',[CourseCategoryController::class,'updateCourseCategory_admin'])->name('admin#updateCourseCategory');
            Route::get('category/delete/{id}',[CourseCategoryController::class,'deleteCourseCategory_admin'])->name('admin#deleteCourseCategory');

        });

        Route::prefix('lesson')->group(function () {
            Route::get('addPage/{id}',[LessonController::class,'addLessonPage_admin'])->name('admin#addLessonPage');
            Route::post('add',[LessonController::class,'add_admin'])->name('admin#addLesson');
            Route::get('view/{id}',[LessonController::class,'view_admin'])->name('admin#viewLesson');
            Route::get('edit/{id}',[LessonController::class,'edit_admin'])->name('admin#editLesson');
            Route::post('update',[LessonController::class,'update_admin'])->name('admin#updateLesson');
            Route::get('delete/{id}',[LessonController::class,'delete_admin'])->name('admin#deleteLesson');
        });

        Route::prefix('students')->group(function () {
            Route::get('list',[CourseDetailController::class,'studentsList_admin'])->name('admin#studentsList');
            Route::get('view/course/{id}',[CourseDetailController::class,'studentsViewCourse_admin'])->name('admin#studentsViewCourse');
            Route::get('change/status/{id}/{status}',[CourseDetailController::class,'studentsChangeStatus_admin'])->name('admin#changeStatus');
            Route::get('view/profile/{id}',[CourseDetailController::class,'studentsViewProfile_admin'])->name('admin#studentsViewProfile');

        });

        Route::prefix('user')->group(function () {
            Route::get('list',[AdminController::class,'user_list'])->name('admin#userList');
            Route::get('view/{id}',[AdminController::class,'user_view'])->name('admin#userView');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('courseCategory/{id}',[CourseCategoryController::class,'getCourseCategory_ajax']);
            Route::get('course',[CourseController::class,'getCourse_ajax']);
        });
    });


    Route::prefix('user')->group(function () {
        Route::get('account/profile',[UserController::class,'profile'])->name('user#profile');
    });


});

require __DIR__.'/auth.php';
