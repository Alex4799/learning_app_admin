<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Message;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(){
        return view('user.account.profile');
    }

    public function login_user(Request $req){
        $data;
        $user=User::where('email',$req->email)->first();
        if (isset($user)) {
            if (Hash::check($req->password, $user->password)) {
                $data=[
                    "user"=>$user,
                    'status'=>'success',
                    'message'=>'Login Success',
                    'token'=>$user->createToken(time())->plainTextToken,
                ];
            }else{
                $data=[
                    "user"=>null,
                    'status'=>'fail',
                    'message'=>'Wrong Password'
                ];
            }
        }else{
            $data=[
                "user"=>null,
                'status'=>'fail',
                'message'=>'User Not Found'
            ];
        }
        return response()->json($data, 200);
    }

    public function register_user(Request $req){
        $user=[
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'gender'=>$req->gender,
            'password'=>Hash::make($req->password),
        ];
        $account=User::create($user);
        $data=[
            'user'=>$account,
            'status'=>'success',
            'message'=>'Login Success',
            'token'=>$account->createToken(time())->plainTextToken,
        ];
        return response()->json($data, 200);
    }

    public function getUserData(){
        $data=Auth::user();
        return response()->json($data, 200);
    }

    public function getMember(){
        $data=User::where('role','admin')->get();
        logger($data);
        return response()->json($data, 200);
    }

    public function updateUser(Request $req){
        $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'gender'=>$req->gender,
        ];
        if ($req->hasFile('image')) {
            $userImage=User::where('id',Auth::user()->id)->first()->image;
            if ($userImage!=null) {
                Storage::delete('public/profile/'.$userImage);
            }
            $imageName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/profile/'.$imageName);
            $data['image']=$imageName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return response()->json(['status'=>'success'], 200);
    }

    public function deleteProfile(){
        $userImage=User::where('id',Auth::user()->id)->first()->image;
        Storage::delete('public/profile/'.$userImage);
        User::where('id',Auth::user()->id)->update(['image'=>null]);
        return response()->json(['status'=>'success'], 200);
    }

    public function deleteAccount(Request $req){
        $data;
        $id=Auth::user()->id;
        if (Hash::check($req->password, Auth::user()->password)) {
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
            $data=[
                'status'=>'success',
            ];
        }else{
            $data=[
                'status'=>'fail',
                'message'=>'Password is wrong!!!. Please Try Again.'
            ];
        }

        return response()->json($data, 200);
    }

    public function changePassword(Request $req){
        if (Hash::check($req->oldPassword, Auth::user()->password)) {
            $hash_value=Hash::make($req->newPassword);
            User::where('id',Auth::user()->id)->update(['password'=>$hash_value]);
            return response()->json(['status'=>'success'], 200);
        }else{
            return response()->json(['status'=>'fail'], 200);
        }
    }
}
