<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use App\Models\UserInterface;
use Illuminate\Support\Facades\Storage;

class UserInterfaceController extends Controller
{
    public function editUserInterface(){
        $data=UserInterface::where('id',1)->first();
        return view('admin.account.editUserInterface',compact('data'));
    }

    public function updateUserInterface(Request $req){

        $data=[
            'title'=>$req->title,
            'category'=>$req->category,
            'address'=>$req->address,
            'phone'=>$req->phone,
            'email'=>$req->email,
            'map'=>$req->map,
        ];
        $oldData=UserInterface::where('id',1)->first();

        if ($req->hasFile('logo_image')) {
            if ($oldData->logo!=null) {
                Storage::delete('public/interface/'.$oldData->logo);
            }
            $logo_image=uniqid().$req->file('logo_image')->getClientOriginalName();
            $req->file('logo_image')->storeAs('public/interface',$logo_image);
            $data['logo']=$logo_image;
        }

        if ($req->hasFile('cover_image')) {
            if ($oldData->logo!=null) {
                Storage::delete('public/interface/'.$oldData->logo);
            }
            $cover_image=uniqid().$req->file('cover_image')->getClientOriginalName();
            $req->file('cover_image')->storeAs('public/interface',$cover_image);
            $data['coverimage']=$cover_image;
        }

        if ($req->font_color!=null) {
            $data['font_color']=$req->font_color;
        }

        if ($req->bg_color!=null) {
            $data['background_color']=$req->bg_color;
        }

        UserInterface::where('id',1)->update($data);
        return redirect()->route('admin#editUserInterface')->with(['UpdateSucc'=>'Update Successful']);
    }

    public function defaultUserInterface(){
        $data=[
            'title'=>'Angle',
            'category'=>'Training Center',
            'background_color'=>'#ffffff',
            'coverimage'=>null,
            'logo'=>null,
            'font_color'=>'#000000',
            'address'=>'Yangon',
            'phone'=>'+959980730638',
            'email'=>'mr.alex4799@gmail.com',
            'map'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488797.97858163906!2d95.85189695302519!3d16.839536845157664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1706984717554!5m2!1sen!2smm',

        ];
        UserInterface::where('id',1)->update($data);
        return redirect()->route('admin#editUserInterface')->with(['UpdateSucc'=>'Update Successful']);
    }


    public function getUserInterface_admin(){
        $layout=UserInterface::where('id',1)->first();
        $messageCount=count(Message::where('get_id',null)->where('status',0)->where('reply_id',null)->get());
        $enrollStatus=count(CourseDetail::where('status',0)->get());
        $data=[
            'layout'=>$layout,
            'messageCount'=>$messageCount,
            'enrollStatus'=>$enrollStatus,
        ];
        return response()->json($data, 200);
    }


    // user

    public function getUserInterface_user(){
        $data=UserInterface::where('id',1)->first();
        return response()->json($data, 200);
    }
}
