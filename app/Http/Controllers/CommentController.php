<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    // user
    public function getComment_user($id){
        $data=Comment::select('comments.*','users.name as user_name')
            ->leftJoin('users','comments.user_id','users.id')
            ->where('comments.lesson_id',$id)
            ->get();
        return response()->json($data, 200);
    }

    public function sendComment_user(Request $req){

        $userData=[
            'user_id'=>Auth::user()->id,
            'lesson_id'=>$req->lesson_id,
            'content'=>$req->content,
            'reply_id'=>$req->reply_id,
        ];
        if ($req->hasFile('image')) {
            $imageName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/commentImage/',$imageName);
            $userData['image']=$imageName;
        }
        Comment::create($userData);
        return redirect()->route('user#getComment',$req->lesson_id);
    }

    public function delete_user($id,$lesson_id){
        $comment=Comment::where('id',$id)->first();
        if ($comment->image!=null) {
            Storage::delete('public/commentImage/'.$comment->image);
        }
        Comment::where('id',$id)->delete();
        $reply=Comment::where('reply_id',$id)->get();
        for ($i=0; $i < count($reply); $i++) {
            if ($reply[$i]->image!=null) {
                Storage::delete('public/commentImage/'.$reply[$i]->image);
            }
        }
        Comment::where('reply_id',$id)->delete();
        return redirect()->route('user#getComment',$lesson_id);

    }
}
