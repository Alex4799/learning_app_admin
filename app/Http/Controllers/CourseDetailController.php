<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Message;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        for ($i=0; $i < count($courses); $i++) {
            $course=CourseDetail::where('course_id',$courses[$i]->course_id)->where('status',0)->get();
            if (count($course) != 0) {
                $courses[$i]->status=true;
            }else{
                $courses[$i]->status=false;
            }
        }
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
        CourseDetail::where('id',$id)->update(['fee_status'=>$status,'status'=>1]);
        $courseDetail=CourseDetail::select('course_details.*','courses.name as course_name','users.name as user_name')
        ->leftJoin('users','course_details.user_id','users.id')
        ->leftJoin('courses','course_details.course_id','courses.id')
        ->where('course_details.id',$id)->first();
        $messageContact="Your $courseDetail->fee_status% payment for $courseDetail->course_name is successful.";
        $message=[
            'send_id'=>Auth::user()->id,
            'get_id'=>$courseDetail->user_id,
            'message'=>$messageContact,
            'status'=>0,
        ];
        Message::create($message);
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

    public function viewEnroll_admin($id){
        $CourseDetail=CourseDetail::select('course_details.*','courses.name as course_name','users.name as user_name')
        ->leftJoin('users','course_details.user_id','users.id')
        ->leftJoin('courses','course_details.course_id','courses.id')
        ->where('course_details.id',$id)->first();
        return view('admin.students.enrollDetail',compact(['CourseDetail']));
    }

    public function deleteStudents(Request $req){
        if (Hash::check($req->password, Auth::user()->password)) {
            Comment::where('user_id',$req->user_id)->delete();
            CourseDetail::where('user_id',$req->user_id)->delete();
            Message::orWhere('send_id',$req->user_id)->orWhere('get_id',$req->user_id)->delete();
            User::where('id',$req->user_id)->delete();
            return redirect()->route('admin#studentsList');
        }else{
            return back()->with(['WrongPassword'=>'Your password is not same. Please try again.']);
        }
    }

    // user

    public function getCourseDetail_user(){
        $data=CourseDetail::select('course_details.*','courses.*')
            ->leftJoin('courses','course_details.course_id','courses.id')
            ->where('course_details.user_id',Auth::user()->id)->get();
        return response()->json($data, 200);
    }

    public function checkCourse_user($id){
        $courseDetail=CourseDetail::where('course_id',$id)->where('user_id',Auth::user()->id)->first();
        $data=[
            'courseDetail'=>'null',
            'status'=>false,
        ];
        if (isset($courseDetail)) {
            $data['courseDetail']=$courseDetail->id;
            $data['status']=$courseDetail->fee_status;
        }
        return response()->json($data, 200);
    }

    public function enroll_user(Request $req){
        $userData = [
            'course_id'=>$req->course_id,
            'user_id'=>Auth::user()->id,
            'status'=>0,
        ];
        if ($req->hasFile('image25')) {
            $filename=uniqid().$req->file('image25')->getClientOriginalName();
            $req->file('image25')->storeAs('public/transationImage',$filename);
            $userData['image25']=$filename;
        }
        if ($req->hasFile('image50')) {
            $filename=uniqid().$req->file('image50')->getClientOriginalName();
            $req->file('image50')->storeAs('public/transationImage',$filename);
            $userData['image50']=$filename;
        }
        if ($req->hasFile('image75')) {
            $filename=uniqid().$req->file('image75')->getClientOriginalName();
            $req->file('image75')->storeAs('public/transationImage',$filename);
            $userData['image75']=$filename;
        }
        if ($req->hasFile('image100')) {
            $filename=uniqid().$req->file('image100')->getClientOriginalName();
            $req->file('image100')->storeAs('public/transationImage',$filename);
            $userData['image100']=$filename;
        }
        if ($req->courseDetailId!='null') {
            CourseDetail::where('id',$req->courseDetailId)->update($userData);
        }else{
            CourseDetail::create($userData);
        }
        User::where('id',Auth::user()->id)->update(['status'=>'students']);
        $data=[
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }

}
