<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    function MakePaiement(){
        return view('usersView.payment.starter');
    }

    function MakePaiementNext(Request $req){

        $req->validate([
            'preuve'=>'required|file|mimes:png,jpg,jpeg,pdf,docx,doc|max:5000000',
            'message'=>'required|nullable',
        ]);

        $dest = public_path('upload_files');
        $name ='doc'.uniqid().'-'.time().'.'.$req['preuve']->extension();

        $req['preuve']->move($dest, $name);

        $pay=new Payment();
        $pay->author_name=Auth::user()->pseudo;
        $pay->user_id=Auth::user()->id;
        $pay->message=$req['message'];
        $pay->image='upload_files/'.$name;
        $pay->save();

        return view('usersView.payment.starter',['msg'=>'success']);
    }

    function MakePaiementStore(){
        $data=DB::table('payments')->where('user_id', Auth::user()->id)->OrderByDesc('id')->get();
        return view('usersView.payment.store',['data'=>$data]);
    }
}
