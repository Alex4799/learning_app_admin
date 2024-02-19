<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\Message;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function changeRole($id,$status){
        User::where('id',$id)->update(['role'=>$status]);
        return back()->with(['updateSucc'=>'User change role successful.']);
    }

    public function addAdminPage(){
        return view('admin.admin.addAdmin');
    }

    public function addAdmin(Request $req){
        if ($req->password==$req->confirm_password) {
            $this->profileValidation($req);
            $data=$this->changeData($req);
            if ($req->hasFile('image')) {
                $imageName=uniqid().$req->file('image')->getClientOriginalName();
                $req->file('image')->storeAs('public/profile',$imageName);
                $data['image']=$imageName;
            }
            $data['password']=Hash::make($req->password);
            $data['role']='admin';

            User::create($data);
            return redirect()->route('admin#list')->with(['createSucc'=>'Admin account create successful.']);

        }else{
            return back()->with(['passwordNSame'=>'Password and confirm password must be same.']);
        }

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

    public function user_delete($id){
            $comments=Comment::where('user_id',$id)->get();
            foreach ($comments as $comment) {
                if ($comment->image!=null) {
                    Storage::delete('public/commentImage/'.$comment->image);
                }
            }
            Message::orWhere('send_id',$id)->orWhere('get_id',$id)->delete();
            $courseDetail=CourseDetail::where('user_id',$id)->get();
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
            CourseDetail::where('user_id',$id)->delete();
            $userImage=User::where('id',$id)->first()->image;
            if ($userImage!=null) {
                Storage::delete('public/profile/'.$userImage);
            }
            User::where('id',$id)->delete();

            return redirect()->route('admin#userList')->with(['deleteSucc'=>'User Account Delete Successful']);

    }

    private function profileValidation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'position'=>'required'
        ])->validate();
    }

    private function changeData($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'gender'=>$req->gender,
            'position'=>$req->position,
        ];
    }
}
