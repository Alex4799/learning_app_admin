<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function getMessage_admin(){
        $message=Message::select('messages.*','users.name as user_name','users.email as user_email')
            ->leftJoin('users','messages.send_id','users.id')
            ->where('messages.get_id',null)->where('messages.reply_id',null)->paginate(10);
        return view('admin.message.messageList',compact('message'));
    }

    public function viewMessage_admin($id){
        Message::where('id',$id)->update(['status'=>1]);
        $message=Message::select('messages.*','users.name as user_name','users.email as user_email')
                ->leftJoin('users','messages.send_id','users.id')
                ->where('messages.id',$id)->first();

        $replyMessage=Message::select('messages.*','users.name as user_name','users.email as user_email')
                ->leftJoin('users','messages.send_id','users.id')
                ->where('messages.reply_id',$id)->get();

        return view('admin.message.viewMessage',compact('message','replyMessage'));
    }

    public function sendMessage_admin(Request $req){
        Validator::make($req->all(),[
            'reply_id'=>'required',
            'message'=>'required',
        ])->validate();

        $message=[
            'send_id'=>Auth::user()->id,
            'get_id'=>$req->get_id,
            'reply_id'=>$req->reply_id,
            'message'=>$req->message,
            'status'=>0,
        ];

        Message::create($message);
        return redirect()->route('admin#viewMessage',$req->reply_id);

    }

    public function checkMessage_admin(){
        $messageCount=count(Message::where('get_id',null)->get());
        return response()->json($messageCount, 200);
    }

    //user
    public function sendMessage_user(Request $req){
        $message=[
            'send_id'=>Auth::user()->id,
            'reply_id'=>$req->reply_id,
            'message'=>$req->message,
            'status'=>0,
        ];
        if ($req->reply_id!=null) {
            Message::where('id',$req->reply_id)->update(['status'=>0]);
        }
        Message::create($message);
        $data=[
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }

    public function checkMessage_user(){
        $message=count(Message::where('get_id',Auth::user()->id)->where('status',0)->get());
        $data=[
            'message_count'=>$message,
        ];
        return response()->json($data, 200);
    }

    public function getMessage_user(){
        $data=Message::select('messages.*','users.name as user_name','users.email as user_email')
        ->leftJoin('users','messages.send_id','users.id')
        ->where('get_id',Auth::user()->id)->get();
        return response()->json($data, 200);
    }

    public function viewMessage_user($id){
        Message::where('id',$id)->update(['status'=>1]);
        $reply=Message::where('id',$id)->first();
        $data;
        if ($reply->reply_id!=null) {

            $message=Message::select('messages.*','users.name as user_name','users.email as user_email')
            ->leftJoin('users','messages.send_id','users.id')
            ->where('messages.id',$reply->reply_id)->first();

            $replyMessage=Message::select('messages.*','users.name as user_name','users.email as user_email')
            ->leftJoin('users','messages.send_id','users.id')
            ->where('messages.reply_id',$message->id)->get();

            $data=[
                'messsage' => $message,
                'replyMessage' => $replyMessage,
            ];

        }else{

            $message=Message::select('messages.*','users.name as user_name','users.email as user_email')
            ->leftJoin('users','messages.send_id','users.id')
            ->where('messages.id',$id)->first();

            $replyMessage=Message::select('messages.*','users.name as user_name','users.email as user_email')
            ->leftJoin('users','messages.send_id','users.id')
            ->where('messages.reply_id',$id)->get();

            $data=[
                'messsage' => $message,
                'replyMessage' => $replyMessage,
            ];
        }
        return response()->json($data, 200);
    }
}
