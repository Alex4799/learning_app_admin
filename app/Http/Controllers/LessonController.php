<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $comment=Comment::select('comments.*','users.name as user_name')
        ->leftJoin('users','comments.user_id','users.id')
        ->where('comments.lesson_id',$id)
        ->get();
        return view('admin.lesson.viewPage',compact('lesson','comment'));
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

        $comment=Comment::where('lesson_id',$id)->get();
        foreach ($comment as $item) {
            if ($item->image!=null) {
                Storage::delete('public/commentImage/'.$item->image);
            }
        }
        Comment::where('lesson_id',$id)->delete();
        Lesson::where('id',$id)->delete();

        $this->changeLessonCount($req);
        return redirect()->route('admin#viewCourseCategory',$req->course_category_id)->with(['deleteSucc'=>'Lesson Delete Successful']);
    }



    // user

    public function getHomeBlog_user(){
        $data=Lesson::where('course_id',1)->paginate(4);
        return response()->json($data, 200);
    }

    public function getBlog_user(){
        $data=Lesson::where('course_id',1)->get();
        return response()->json($data, 200);
    }

    public function getBlogDetail_user($id){
        $blog=Lesson::where('id',$id)->first();
        $data=[
            'blog'=>$blog,
            'user_id'=>Auth::user()->id,
        ];
        return response()->json($data, 200);
    }

    public function viewLesson_user($id){
        $lesson=Lesson::where('id',$id)->first();
        $course=CourseDetail::where('course_id',$lesson->course_id)->where('user_id',Auth::user()->id)->first();
        $lessons=Lesson::where('course_id',$lesson->course_id)->get();
        $data=[
            'lesson'=>$lesson,
            'lessons'=>$lessons,
            'course'=>$course,
            'user_id'=>Auth::user()->id,
        ];
        return response()->json($data, 200);
    }

    public function doneLesson_user($id){
        $done_lesson=CourseDetail::where('id',$id)->first()->done_lesson;
        CourseDetail::where('id',$id)->update(['done_lesson'=>$done_lesson+1]);
        $data=[
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }


    // private function
    private function check_validation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
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
