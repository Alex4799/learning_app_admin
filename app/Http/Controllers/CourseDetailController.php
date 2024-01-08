<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseDetailController extends Controller
{
    public function studentsList_admin(){
        $courses=CourseDetail::select('course_details.*','courses.name as course_name',DB::raw('COUNT("course_details.course_id") as students_count'))
                ->leftJoin('courses','courses.id','course_details.course_id')
                ->groupBy('course_details.course_id')
                ->when(request('search_key'),function($query){
                    $query->where('courses.name','like','%'.request('search_key').'%');
                })
                ->get();
        return view('admin.students.list',compact('courses'));
    }

    public function studentsViewCourse_admin($id){
        $students=CourseDetail::select('course_details.*','users.image as user_image','users.name as user_name','users.id as user_id')
                  ->leftJoin('users','course_details.user_id','users.id')
                  ->when(request('search_key'),function($query){
                        $query->where('users.name','like','%'.request('search_key').'%');
                    })
                  ->where('course_id',$id)->paginate(10);
        $course=Course::where('id',$id)->first();
        return view('admin.students.view',compact(['students','course']));
    }

    public function studentsChangeStatus_admin($id,$status){
        CourseDetail::where('id',$id)->update(['fee_status'=>$status]);
        return back()->with(['updateSucc'=>'Change status successful']);
    }

    public function studentsViewProfile_admin($id){
        $user=User::where('id',$id)->first();
        $courses=CourseDetail::select('course_details.*','courses.name as course_name','courses.lesson_count')
            ->leftJoin('courses','course_details.course_id','courses.id')
            ->where('course_details.user_id',$id)->get();
        // dd($courses);
        return view('admin.students.profile',compact(['user','courses']));
    }
}
