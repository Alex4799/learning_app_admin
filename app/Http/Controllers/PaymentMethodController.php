<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function paymentList_admin(){
        $payment=PaymentMethod::paginate(10);
        return view('admin.payment.list',compact('payment'));
    }

    public function paymentAddPage_admin(){
        return view('admin.payment.add');
    }

    public function paymentAdd_admin(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        PaymentMethod::create($data);
        return redirect()->route('admin#paymentList')->with(['success'=>'Payment Create Successful.']);
    }

    public function paymentView_admin($id){
        $payment=PaymentMethod::where('id',$id)->first();
        return view('admin.payment.view',compact('payment'));
    }

    public function paymentEdit_admin($id){
        $payment=PaymentMethod::where('id',$id)->first();
        return view('admin.payment.edit',compact('payment'));
    }

    public function paymentUpdate_admin(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        PaymentMethod::where('id',$req->id)->update($data);
        return redirect()->route('admin#paymentList')->with(['success'=>'Payment Update Successful.']);;
    }

    public function paymentDelete_admin($id){
        PaymentMethod::where('id',$id)->delete();
        return redirect()->route('admin#paymentList')->with(['danger'=>'Payment Delete Successful.']);;
    }

    // user
    public function getPayment_user(){
        $data=PaymentMethod::get();
        return response()->json($data, 200);
    }

    private function validation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'number'=>'required',
            'username'=>'required',
            'video'=>'required',
        ])->validate();
    }

    private function changeFormat($req){
        return [
            'name'=>$req->name,
            'number'=>$req->number,
            'user_name'=>$req->username,
            'video'=>$req->video,
        ];
    }
}
