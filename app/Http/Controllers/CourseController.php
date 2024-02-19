<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // public function
    //admin
    public function list_admin(){
        $courses=Course::when(request('search_key'),function($item){
            $item->where('name','like','%'.request('search_key').'%');
        })
        ->paginate(10);
        return view('admin.course.courseList',compact('courses'));
    }

    public function addPage_admin(){
        return view('admin.course.addCourse');
    }

    public function add_admin(Request $req){
        $this->course_validation_check($req);
        $data=$this->changeDataFormat($req);

        $imageName=uniqid().$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/courseImage',$imageName);
        $data['image']=$imageName;
        Course::create($data);
        return redirect()->route('admin#courseList')->with(['createSucc'=>'Course create successful.']);
    }

    public function view_admin($id){
        $courseCategory=CourseCategory::where('course_id',$id)->get();
        $course=Course::where('id',$id)->first();
        return view('admin.course.viewCourse',compact(['course','courseCategory']));
    }

    public function edit_admin($id){
        $course=Course::where('id',$id)->first();
        return view('admin.course.editCourse',compact('course'));
    }

    public function update_admin(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
            'course_fee'=>'required',
        ])->validate();
        $data=$this->changeDataFormat($req);
        if ($req->hasFile('image')) {
            $dbimage=Course::where('id',$req->id)->first()->image;
            if ($dbimage!=null) {
                Storage::delete('public/courseImage/'.$dbimage);
            }
            $imageName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/courseImage',$imageName);
            $data['image']=$imageName;
        }
        Course::where('id',$req->id)->update($data);
        return redirect()->route('admin#courseList')->with(['updateSucc'=>'Course update successful.']);
    }

    public function delete_admin($id){
        $lesson=Lesson::where('course_id',$id)->get();
        if (count($lesson)==0) {

            $courseDetail=CourseDetail::where('course_id',$id)->get();
            foreach ($courseDetail as $item) {
                if($item->image25!=null){
                    Storage::delete('public/transationImage/'.$item->image25);
                }
                if($item->image50!=null){
                    Storage::delete('public/transationImage/'.$item->image50);
                }
                if($item->image75!=null){
                    Storage::delete('public/transationImage/'.$item->image75);
                }
                if($item->image100!=null){
                    Storage::delete('public/transationImage/'.$item->image100);
                }
            }
            CourseDetail::where('course_id',$id)->delete();
            CourseCategory::where('course_id',$id)->delete();
            $dbimage=Course::where('id',$id)->first()->image;
            if ($dbimage!=null) {
                Storage::delete('public/courseImage/'.$dbimage);
            }
            Course::where('id',$id)->delete();

            return redirect()->route('admin#courseList')->with(['deleteSucc'=>'Course delete successful.']);
        }else{
            return redirect()->route('admin#viewCourse',$id)->with(['deleteFail'=>'Lesson is not empty in this course. Please delete or move first.']);

        }

    }

    public function getCourse_ajax(){
        $course=Course::get();
        return response()->json($course, 200);
    }

    // user

    public function getHomeCourse_user(){
        $courses=Course::paginate(4);
        return response()->json($courses, 200);
    }

    public function getCourse_user(){
        $courses=Course::get();
        return response()->json($courses, 200);
    }

    public function getCourseDetail_user($id){
        $courseCategory=CourseCategory::where('course_id',$id)->get();
        $course=Course::where('id',$id)->first();
        $data=[
            'course'=>$course,
            'courseCategory'=>$courseCategory,
        ];
        return response()->json($data, 200);
    }

    public function getUserCourse_user($id){
        $data=Course::where('id',$id)->first();
        return response()->json($data, 200);
    }


    // private function
    private function course_validation_check($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
            'course_fee'=>'required',
            'image'=>'required',
        ])->validate();
    }

    private function changeDataFormat($req){
        return [
            'name'=>$req->name,
            'course_fee'=>$req->course_fee,
            'description'=>$req->description,
        ];
    }
}
