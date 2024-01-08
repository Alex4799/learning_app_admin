<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    public function courseCategoryList_admin($id){
        $courseCategory=CourseCategory::where('course_id',$id)->get();
        $course=Course::where('id',$id)->first();
        return view('admin.course.category.categoryList',compact(['courseCategory','course']));
    }

    public function addCourseCategoryPage_admin($course_id){
        return view('admin.course.category.addCategory',compact('course_id'));
    }

    public function addCourseCategory_admin(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'course_id'=>'required',
        ])->validate();

        $data=[
            'name'=>$req->name,
            'course_id'=>$req->course_id,
        ];
        CourseCategory::create($data);
        $courseCategoryCount=count(CourseCategory::where('course_id',$req->course_id)->get());
        Course::where('id',$req->course_id)->update(['course_category_count'=>$courseCategoryCount]);
        return redirect()->route('admin#courseCategoryList',$req->course_id)->with(['createSucc'=>'Course category create success']);

    }

    public function viewCourseCategory_admin($id){
        $lesson=Lesson::where('course_category_id',$id)->get();
        $courseCategory=CourseCategory::where('id',$id)->first();
        return view('admin.lesson.list',compact(['lesson','courseCategory']));
    }

    public function editCourseCategory_admin($id){
        $courseCategory=CourseCategory::where('id',$id)->first();
        return view('admin.course.category.editCategory',compact('courseCategory'));
    }

    public function updateCourseCategory_admin(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
        ])->validate();

        $data=[
            'name'=>$req->name,
        ];
        CourseCategory::where('id',$req->id)->update($data);
        $courseCategory=CourseCategory::where('id',$req->id)->first();
        return redirect()->route('admin#courseCategoryList',$courseCategory->course_id)->with(['UpdateSucc'=>'Course category update successful.']);
    }

    public function deleteCourseCategory_admin($id){
        $lesson=Lesson::where('course_category_id',$id)->get();
        $CourseCategory=CourseCategory::where('id',$id)->first();
        if(count($lesson)!=0){
            return redirect()->route('admin#courseCategoryList',$CourseCategory->course_id)->with(['deleteFail'=>'Course Category delete fail.This Course Category is not empty.']);
        }
        CourseCategory::where('id',$id)->delete();
        $courseCategoryCount=count(CourseCategory::where('course_id',$CourseCategory->course_id)->get());
        Course::where('id',$CourseCategory->course_id)->update(['course_category_count'=>$courseCategoryCount]);
        return redirect()->route('admin#courseCategoryList',$CourseCategory->course_id)->with(['DeleteSucc'=>'Course Category delete successful.']);
    }

    public function getCourseCategory_ajax($id){
        $courseCategory=CourseCategory::where('course_id',$id)->get();
        return response()->json($courseCategory, 200);
    }

}
