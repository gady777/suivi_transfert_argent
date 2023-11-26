<?php

namespace App\Http\Controllers;

use App\Models\TransferTranche;
use App\Models\TransferTrancheInstance;
use Illuminate\Http\Request;

class TransferTrancheController extends Controller
{
    private const page = "transfer_tranche";

    public function list(){
        $ts = TransferTranche::where('user_id',Auth()->user()->id)->orderBy('id','DESC')->get();
        return view("usersView.transfer_tranche.list",[
            "ts"=>$ts,
            "page_name"=>self::page
        ]);
    }

    public function detail($id){
        $t = TransferTranche::where('id',$id)->where('user_id',Auth()->user()->id)->firstOrFail();
        $tcs = TransferTrancheInstance::where('type','reception')
                                        ->where('transfer_tranche_id',$t->id)
                                        ->get();
        return view("usersView.transfer_tranche.detail",[
            "t"=>$t,
            'tcs'=>$tcs,
            "page_name"=>self::page
        ]); 
    }
    public function senddes($id){
        $t = TransferTranche::findOrFail($id);
        $cs = TransferTrancheInstance::where('transfer_tranche_id',$id)->where('type','envoi')->get();

        return view("usersView.transfer_tranche.detail-reception",[
            'rs'=>$cs,
            "t"=>$t,
            "page_name"=>self::page
        ]);
    }

    public function sendtu($id){
        $t = TransferTranche::findOrFail($id);
        $cs = TransferTrancheInstance::where('transfer_tranche_id',$id)->where('type','reception')->get();

        return view("usersView.transfer_tranche.detail-envoi",[
            'ts'=>$cs,
            "t"=>$t,
            "page_name"=>self::page
        ]);
    }
}
