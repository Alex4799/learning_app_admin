<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboardPage(){
        $students=count(User::where('status','students')->get());
        $user=count(User::where('role','user')->get());
        $course=count(Course::get());
        $member=count(User::where('role','admin')->get());
        $lesson=count(Lesson::get());
        $data=[
            'students'=>$students,
            'user'=>$user,
            'course'=>$course,
            'member'=>$member,
            'lesson'=>$lesson,
        ];
        return view('admin.account.dashboard',compact('data'));
    }

    public function profile(){
        return view('admin.account.profile');
    }

    public function editProfile(){
        return view('admin.account.editProfile');
    }

    public function updateProfile(Request $req){
        $this->profileValidation($req);
        $data=$this->changeData($req);
        if ($req->hasFile('image')) {
            $oldImage=User::where('id',Auth::user()->id)->first()->image;
            if ($oldImage!=null) {
                Storage::delete('public/profile/'.$oldImage);
            }
            $imageName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/profile',$imageName);
            $data['image']=$imageName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('admin#profile')->with(['updateSucc'=>'Profile update Successful.']);
    }

    public function deleteProfilePhoto(){
        $oldImage=User::where('id',Auth::user()->id)->first()->image;
        if ($oldImage!=null) {
            Storage::delete('public/profile/'.$oldImage);
        }
        User::where('id',Auth::user()->id)->update(['image'=>null]);
        return redirect()->route('admin#profile')->with(['deleteSucc'=>'Profile Photo delete Successful.']);
    }

    public function adminList(){
        $user=User::where('role','admin')
        ->when(request('search_key'),function($query){
            $query->where('name','like','%'.request('search_key').'%');
        })
        ->paginate(10);
        return view('admin.admin.list',compact('user'));
    }

    public function adminView($id){
        $user=User::where('id',$id)->first();
        return view('admin.admin.view',compact('user'));
    }

    //user
    public function user_list(){
        $user=User::where('role','user')->when(request('status'),function($query){
            $query->where('status',request('status'));
        })->when(request('search_key'),function($query){
            $query->where('name','like','%'.request('search_key').'%');
        })
        ->paginate(10);
        return view('admin.user.list',compact('user'));
    }

    public function user_view($id){
        $user=User::where('id',$id)->first();
        $courses=CourseDetail::select('course_details.*','courses.name as course_name','courses.lesson_count')
            ->leftJoin('courses','course_details.course_id','courses.id')
            ->where('course_details.user_id',$id)->get();
        // dd($courses);
        return view('admin.user.view',compact(['user','courses']));
    }

    private function profileValidation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required'
        ])->validate();
    }

    private function changeData($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'gender'=>$req->gender,
        ];
    }
}
