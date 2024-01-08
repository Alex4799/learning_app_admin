<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    //public function
    public function addLessonPage_admin($id){
        $courseCategory=CourseCategory::where('id',$id)->first();
        return view('admin.lesson.addPage',compact(['id','courseCategory']));
    }

    public function add_admin(Request $req){
        $this->check_validation($req);
        $data=$this->changeData($req);
        Lesson::create($data);
        $this->changeLessonCount($req);

        return redirect()->route('admin#viewCourseCategory',$req->course_category_id)->with(['createSucc'=>'Lesson Create Successful']);
    }

    public function view_admin($id){
        $lesson=Lesson::where('id',$id)->first();
        return view('admin.lesson.viewPage',compact('lesson'));
    }

    public function edit_admin($id){
        $lesson=Lesson::where('id',$id)->first();
        $course=Course::get();
        $courseCategory=CourseCategory::get();
        return view('admin.lesson.edit',compact(['lesson','course','courseCategory']));
    }

    public function update_admin(Request $req){
        $this->check_validation($req);
        $data=$this->changeData($req);
        $lesson=Lesson::where('id',$req->id)->first();
        Lesson::where('id',$req->id)->update($data);
        $this->changeLessonCount($req);
        $this->changeLessonCount($lesson);
        return redirect()->route('admin#viewLesson',$req->id)->with(['updateSucc'=>'Lesson Update Successful']);
    }

    public function delete_admin($id){
        $req=Lesson::where('id',$id)->first();
        Lesson::where('id',$id)->delete();
        $this->changeLessonCount($req);
        return redirect()->route('admin#viewCourseCategory',$req->course_category_id)->with(['deleteSucc'=>'Lesson Delete Successful']);
    }

    // private function
    private function check_validation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
            'vd_link'=>'required',
            'course_id'=>'required',
            'course_category_id'=>'required',
        ])->validate();
    }

    private function changeData($req){
        return [
            'name'=>$req->name,
            'description'=>$req->description,
            'vd_link'=>$req->vd_link,
            'course_id'=>$req->course_id,
            'course_category_id'=>$req->course_category_id,
        ];
    }

    private function changeLessonCount($req){
        $CLessonCount=count(Lesson::where('course_id',$req->course_id)->get());
        Course::where('id',$req->course_id)->update(['lesson_count'=>$CLessonCount]);

        $CCLessonCount=count(Lesson::where('course_category_id',$req->course_category_id)->get());
        CourseCategory::where('id',$req->course_category_id)->update(['lesson_count'=>$CCLessonCount]);
    }
}
