<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
